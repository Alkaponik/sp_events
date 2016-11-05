<?php

/**
 * @author Pavel Usachev <webcodekeeper@hotmail.com>
 * @copyright Copyright (c) 2016, Pavel Usachev
 */

/**
 * Class SP_Events_Helper_Data
 */
class SP_Events_Helper_Data
    extends Mage_Core_Helper_Abstract
{

    const IS_ENABLE_PATH = 'sp_events/general/enabled';
    const SENDER_NAME_PATH = 'sp_events/general/sender_name';

    const ALLOWED_EXTENSION_IMAGE_NODE_PATH  = 'default/sp_events/extension/image_allowed';

    /**
     * @var Varien_Io_File
     */
    protected $_ioFile;

    /**
     * @var array;
     */
    protected $_allowedExtensions;

    /**
     * SP_Events_Helper_Data constructor.
     */
    public function __construct()
    {
        $this->_ioFile = new Varien_Io_File();
        $this->_allowedExtensions = $this->_getAllowedExtensions();
    }

    /**
     * @return bool
     */
    public function isEnabled()
    {
        return (bool)Mage::getStoreConfig(self::IS_ENABLE_PATH);
    }

    /**
     * @return string
     */
    public function getSenderName()
    {
        return Mage::getStoreConfig(self::SENDER_NAME_PATH);
    }

    /**
     * @param array $data
     */
    public function savePostData(array $data)
    {

        if ($imageName = $this->uploadFile()) {
            $data['image'] = $imageName;
        }

        $model = Mage::getModel('sp_events/event');
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
                $uploader->setAllowedExtensions($this->_allowedExtensions);
                $uploader->setAllowRenameFiles(true);
                $uploader->setAllowCreateFolders(true);
                $uploader->setFilesDispersion(false);
                $path = Mage::getBaseDir('media') . DS . 'sp_events' . DS;
                $imageName = preg_replace('/\s+/', '_', $_FILES['image']['name']);

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
     * @param  string $fileName
     * @return string
     */
    public function resizeImage($fileName)
    {
        $basePath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS . 'sp_events' . DS . $fileName;
        $newPath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS . 'sp_events' . DS . "resized" . DS . $fileName;

        //if image has already resized then just return URL
        if (file_exists($basePath) && is_file($basePath) && !file_exists($newPath)) {
            $imageObj = new Varien_Image($basePath);
            $imageObj->constrainOnly(true);
            $imageObj->keepAspectRatio(false);
            $imageObj->keepFrame(false);
            $imageObj->resize(146, 67);
            $imageObj->save($newPath);
        }

        $resizedURL = Mage::getBaseUrl(Mage_Core_Model_Store::URL_TYPE_MEDIA) . "resized" . DS . $fileName;

        return $resizedURL;
    }

    /**
     * @param $fileName
     */
    public function deleteImage($fileName)
    {
        $basePath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA) . DS . 'sp_events' . DS . $fileName;
        $resizedPath = Mage::getBaseDir(Mage_Core_Model_Store::URL_TYPE_MEDIA). DS . 'sp_events' . DS . "resized" . DS . $fileName;

        if (file_exists($basePath)) {
            unlink($basePath);
        }

        if (file_exists($resizedPath)) {
            unlink($resizedPath);
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

