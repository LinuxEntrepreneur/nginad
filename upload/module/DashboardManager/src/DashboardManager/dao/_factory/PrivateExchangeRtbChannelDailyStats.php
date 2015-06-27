<?php
/**
 * CDNPAL NGINAD Project
 *
 * @link http://www.nginad.com
 * @copyright Copyright (c) 2013-2015 CDNPAL Ltd. All Rights Reserved
 * @license GPLv3
 */

namespace _factory;

use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\TableGateway\Feature;
use Zend\Db\Sql\Sql;
use Zend\Db\Metadata\Metadata;

class PrivateExchangeRtbChannelDailyStats extends \_factory\CachedTableRead
{

    static protected $instance = null;

    public static function get_instance() {

            if (self::$instance == null):
                    self::$instance = new \_factory\PrivateExchangeRtbChannelDailyStats();
            endif;
            return self::$instance;
    }
    
    function __construct() {

            $this->table = 'PrivateExchangeRtbChannelDailyStats';
            $this->featureSet = new Feature\FeatureSet();
            $this->featureSet->addFeature(new Feature\GlobalAdapterFeature());
            $this->initialize();
    }

    public function get_row($params = null) {
        // http://files.zend.com/help/Zend-Framework/zend.db.select.html

        $obj_list = array();

        $resultSet = $this->select(function (\Zend\Db\Sql\Select $select) use ($params) {
        	foreach ($params as $name => $value):
        	$select->where(
        			$select->where->equalTo($name, $value)
        	);
        	endforeach;
        	$select->limit(1, 0);
        	$select->order('PrivateExchangeRtbChannelDailyStatsID');

        }
        	);

    	    foreach ($resultSet as $obj):
    	         return $obj;
    	    endforeach;

        	return null;
    }

    public function get($params = null) {
        	// http://files.zend.com/help/Zend-Framework/zend.db.select.html

        $obj_list = array();

    	$resultSet = $this->select(function (\Zend\Db\Sql\Select $select) use ($params) {
        		foreach ($params as $name => $value):
        		$select->where(
        				$select->where->equalTo($name, $value)
        		);
        		endforeach;
        		//$select->limit(10, 0);
        		$select->order('PrivateExchangeRtbChannelDailyStatsID');

        	}
    	);

    	    foreach ($resultSet as $obj):
    	        $obj_list[] = $obj;
    	    endforeach;

    		return $obj_list;
    }
    
    public function insertPrivateExchangeRtbChannelDailyStats(\model\PrivateExchangeRtbChannelDailyStats $PrivateExchangeRtbChannelDailyStats) {
    	$data = array(
    			'PublisherWebsiteID'   				=> $PrivateExchangeRtbChannelDailyStats->PublisherWebsiteID,
    			'MDYH'   							=> $PrivateExchangeRtbChannelDailyStats->MDYH,
    			'ImpressionsOfferedCounter'   		=> $PrivateExchangeRtbChannelDailyStats->ImpressionsOfferedCounter,
    			'AuctionBidsCounter'   				=> $PrivateExchangeRtbChannelDailyStats->AuctionBidsCounter,
    			'DateCreated'   					=> $PrivateExchangeRtbChannelDailyStats->DateCreated
    	);

    	$this->insert($data);
    }

    public function updatePrivateExchangeRtbChannelDailyStats(\model\PrivateExchangeRtbChannelDailyStats $PrivateExchangeRtbChannelDailyStats) {
    	$data = array(
    			'ImpressionsOfferedCounter'   		=> $PrivateExchangeRtbChannelDailyStats->ImpressionsOfferedCounter,
    			'AuctionBidsCounter'   				=> $PrivateExchangeRtbChannelDailyStats->AuctionBidsCounter
    	);

    	$private_exchange_rtb_channel_daily_stats_id = (int)$PrivateExchangeRtbChannelDailyStats->PrivateExchangeRtbChannelDailyStatsID;
    	$this->update($data, array('PrivateExchangeRtbChannelDailyStatsID' => $private_exchange_rtb_channel_daily_stats_id));
    }
    
    public function incrementPrivateExchangeRtbChannelDailyStatsCached($config, $publisher_website_id, $impressions_offered_counter, $auction_bids_counter) {
    	
    	$params = array();
    	$params["PublisherWebsiteID"] 	= $publisher_website_id;
    	
    	$class_dir_name = 'PrivateExchangeRtbChannelDailyStats';
    	
    	$cached_key_exists = \util\CacheSql::does_cached_write_exist_apc($config, $params, $class_dir_name);

    	if ($cached_key_exists):
    	
	    	// increment bucket
	    	\util\CachedStatsWrites::increment_cached_write_result_ssp_rtb_channel_stats($config, $params, $class_dir_name, $impressions_offered_counter, $auction_bids_counter);
    	
    	else:
    	
	    	// get value sum from apc
	    	$current = \util\CacheSql::get_cached_read_result_apc($config, $params, $class_dir_name);

    		if ($current != null):
    		
	    		$impressions_offered_counter 	= $current["impressions_offered_counter"];
		    	$auction_bids_counter 			= $current["auction_bids_counter"];

		    	// write out values
		    	$this->incrementPrivateExchangeRtbChannelDailyStats($config, $publisher_website_id, $impressions_offered_counter, $auction_bids_counter);

		    endif;
		    
	    	// delete existing key - reset bucket
	    	\util\CacheSql::delete_cached_write_apc($config, $params, $class_dir_name);
	    	 
	    	// increment bucket
	    	\util\CachedStatsWrites::increment_cached_write_result_ssp_rtb_channel_stats($config, $params, $class_dir_name, $impressions_offered_counter, $auction_bids_counter);
	    	
    	endif;
    	
    }

    public function incrementPrivateExchangeRtbChannelDailyStats($config, $publisher_website_id, $impressions_offered_counter, $auction_bids_counter) {
    	
    	$PrivateExchangeRtbChannelDailyStatsFactory = \_factory\PrivateExchangeRtbChannelDailyStats::get_instance();
    	
    	$current_hour = date("m/d/Y H");
    	
    	$params = array();
    	$params["PublisherWebsiteID"] 	= $publisher_website_id;
    	$params["MDYH"] 				= $current_hour;
    	$PrivateExchangeRtbChannelDailyStats 		= $PrivateExchangeRtbChannelDailyStatsFactory->get_row($params);
    	
    	$private_exchange_rtb_channel_daily_stats = new \model\PrivateExchangeRtbChannelDailyStats();
    	$private_exchange_rtb_channel_daily_stats->PublisherWebsiteID 		= $publisher_website_id;
    	
    	if ($PrivateExchangeRtbChannelDailyStats != null):
    	
	    	$private_exchange_rtb_channel_daily_stats->BuySideHourlyBidsCounterID = $PrivateExchangeRtbChannelDailyStats->PrivateExchangeRtbChannelDailyStatsID;
	    	$private_exchange_rtb_channel_daily_stats->BidsCounter = $PrivateExchangeRtbChannelDailyStats->ImpressionsOfferedCounter + $impressions_offered_counter;
	    	$private_exchange_rtb_channel_daily_stats->BidsCounter = $PrivateExchangeRtbChannelDailyStats->AuctionBidsCounter + $auction_bids_counter;
	    	$PrivateExchangeRtbChannelDailyStatsFactory->updatePrivateExchangeRtbChannelDailyStats($private_exchange_rtb_channel_daily_stats);
    	else:
    	
	    	$private_exchange_rtb_channel_daily_stats->MDYH = $current_hour;
	    	$private_exchange_rtb_channel_daily_stats->BidsCounter = $impressions_offered_counter;
	    	$private_exchange_rtb_channel_daily_stats->BidsCounter = $auction_bids_counter;
	    	$private_exchange_rtb_channel_daily_stats->DateCreated = date("Y-m-d H:i:s");
	    	$PrivateExchangeRtbChannelDailyStatsFactory->insertPrivateExchangeRtbChannelDailyStats($private_exchange_rtb_channel_daily_stats);
    	endif;
    	
    }

};