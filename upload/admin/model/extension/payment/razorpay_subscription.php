<?php
class ModelExtensionPaymentRazorpaySubscription extends Model
{
    public function createTables()
    {   
        $this->db->query(
            "CREATE TABLE IF NOT EXISTS `".DB_PREFIX."razorpay_plans` (
            `entity_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
            `plan_id` varchar(40) NOT NULL,
            `magento_product_id` int(11) NOT NULL,
            `plan_name` varchar(255) NOT NULL,
            `plan_desc` int(11) NOT NULL,
            `plan_type` varchar(30) NOT NULL,
            `plan_interval` int(11) NOT NULL DEFAULT 1,
            `plan_bill_cycle` varchar(255) NOT NULL,
            `plan_trial` decimal(15,2) NOT NULL DEFAULT 0,
            `plan_bill_amount` decimal(15,2) NOT NULL DEFAULT 0,
            `plan_addons` decimal(15,2) NOT NULL DEFAULT 0,
            `plan_status` int(11) NOT NULL DEFAULT 1,
            `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (`entity_id`)
            ) ENGINE=InnoDB DEFAULT CHARSET=utf8;"
        );
    

 
    }
    public function dropTables()
    {
        $this->db->query("DROP TABLE IF EXISTS `".DB_PREFIX."razorpay_plans`");
 
    }
}
    
?>