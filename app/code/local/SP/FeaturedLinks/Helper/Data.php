<?php

class SP_FeaturedLinks_Helper_Data
    extends Mage_Core_Helper_Abstract
{
    /**
     * @param array $data
     */
    public function savePostData(array $data)
    {
        if (is_array($data['image']) && isset($data['image']['value'])) {
            $data['image'] = $data['image']['value'];
        }

        if ($imageName = $this->uploadFile()) {
            $data['image'] = $imageName;
        }

        if (empty($data['title'])) {
            throw new Exception('Title is required');
        }
        if (empty($data['display_from'])) {
            throw new Exception('Date is required');
        }

        $model = Mage::getModel('sp_featuredlinks/featuredlinks');
        $model->setData($data);
        $model->save();
    }

    /**
     * @return string|bool
     */
    public function uploadFile()
    {
        if (isset($_FILES['image']['name']) && $_FILES['image']['name'] != '') {
            try {
                $uploader = new Varien_File_Uploader('image');
                $uploader->setAllowedExtensions(['jpg', 'png']);
                $uploader->setAllowRenameFiles(true);
                $uploader->setAllowCreateFolders(true);
                $uploader->setFilesDispersion(false);
                $path = Mage::getBaseDir('media') . DS;
                $imageName = preg_replace('/\s+/', '_', $_FILES['image']['name']) . mt_rand(1, 1000);

                $uploader->save($path, $imageName);

                return $imageName;

            } catch (Exception $e) {
                Mage::logException($e);
                Mage::getSingleton('adminhtml/session')->addError($this->__('Image upload failed'));
            }
        }

        return false;
    }


    /**
     * @param $fileName
     */
    public function deleteImage($fileName)
    {
        $basePath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS . $fileName;

        if (file_exists($basePath)) {
            unlink($basePath);
        }
    }

    /**
     * @return array
     */
    protected function _getAllowedExtensions()
    {
        $config = Mage::getConfig()
            ->loadModulesConfiguration('config.xml')
            ->getNode(self::ALLOWED_EXTENSION_IMAGE_NODE_PATH)
            ->asArray();

        return array_keys($config);
    }
}