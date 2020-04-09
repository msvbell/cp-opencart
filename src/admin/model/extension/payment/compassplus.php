<?php

class ModelExtensionPaymentCompassplus extends Model
{
    const CA_CRT = 'CA.crt';
    const COMPASSPLUS_PEM = 'compassplus.crt';
    const COMPASSPLUS_KEY = 'compassplus.key';
    const PATH_TO_COMPASSPLUS_CERTS = 'library/compassplus/';

    private function certToFile($certString, $fileName)
    {
        list($fullPath, $info) = $this->getFileInfo($fileName);
        if (!$info->isFile()) {
            file_put_contents($fullPath, $certString);
        } else {
            $currentCrtInFileString = file_get_contents($fullPath);
            if ($currentCrtInFileString != $certString) {
                file_put_contents($fullPath, $certString);
            }
        }
    }

    private function getCert($fileName)
    {
        list($fullPath, $info) = $this->getFileInfo($fileName);
        if ($info->isFile()) {
            return file_get_contents($fullPath);
        }

        return '';
    }

    public function getRootCert()
    {
        return $this->getCert(self::CA_CRT);
    }

    public function getClientCert()
    {
        return $this->getCert(self::COMPASSPLUS_PEM);
    }

    public function saveClientCertToFile($certString)
    {
        $this->certToFile($certString, self::COMPASSPLUS_PEM);
    }

    public function saveClientKey($keyString)
    {
        $this->certToFile($keyString, self::COMPASSPLUS_KEY);
    }

    public function getClientKey()
    {
        return $this->getCert(self::COMPASSPLUS_KEY);
    }

    public function saveRootCertToFile($certString)
    {
        $this->certToFile($certString, self::CA_CRT);
    }

    /**
     * $this->db
     */
    public function install()
    {
        $this->db->query("
            CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "compassplus_order` (
			  `id` INT(11) NOT NULL AUTO_INCREMENT,
			  `order_id` INT(11) NOT NULL,
			  `compassplus_order_id` VARCHAR(128),
			  `session_id` VARCHAR(128),
			  `date_added` DATETIME NOT NULL,
			  `currency_code` CHAR(3) NOT NULL,
			  `total` DECIMAL( 10, 2 ) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;
        ");

        $this->db->query("
			CREATE TABLE IF NOT EXISTS `" . DB_PREFIX . "compassplus_order_transaction` (
			  `id` INT(11) NOT NULL AUTO_INCREMENT,
			  `compassplus_order_id` INT(11) NOT NULL,
			  `date_added` DATETIME NOT NULL,
			  `type` ENUM('check-signature', 'get-url', 'credit', 'debit', 'pending-debit', 'refund-debit', 'authorization', 'authorization-only', 'capture-authorization', 'order', 'pending-credit', 'preauthorization', 'refund-capture', 'void-authorization') DEFAULT NULL,
			  `amount` DECIMAL( 10, 2 ) NOT NULL,
			  PRIMARY KEY (`id`)
			) ENGINE=MyISAM DEFAULT COLLATE=utf8_general_ci;");


    }

    public function uninstall()
    {
        $this->db->query("DROP TABLE IF EXISTS `" . DB_PREFIX . "compassplus_order`;");
    }

    /**
     * @param $fileName
     * @return array
     */
    private function getFileInfo($fileName)
    {
        $path = DIR_SYSTEM . self::PATH_TO_COMPASSPLUS_CERTS;
        $fullPath = $path . $fileName;
        $info = new SplFileInfo($fullPath);
        return array($fullPath, $info);
    }

    public function getOrder($order_id)
    {
        $query = $this->db->query("SELECT * FROM `" . DB_PREFIX . "compassplus_order` WHERE `order_id` = '" . (int)$order_id . "'");
        return array(
            "order_id" => $query->row['order_id'],
            "compassplus_order_id" => $query->row['compassplus_order_id'],
            "session_id" => $query->row['session_id'],
            "date_added" => $query->row['date_added'],
            "currency_code" => $query->row['currency_code'],
            "total" => $query->row['total'],
        );
    }
}
