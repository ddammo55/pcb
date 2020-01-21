<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
	 use Searchable;
	protected $fillable = [
		'serial_name',
		'board_name',
		'product_date',
		'shipment',
		'user_id',
		'aoi_top_part_num',
		'aoi_top_df_num',
		'aoi_top_df_01',
		'aoi_top_df_02',
		'aoi_top_df_03',
		'aoi_top_df_04',
		'aoi_top_df_05',
		'aoi_top_df_06',
		'aoi_top_df_07',
		'aoi_top_df_08',
		'aoi_top_df_09',
		'aoi_top_df_10',
		'aoi_top_df_11',
		'aoi_top_df_12',

		'aoi_bot_part_num',
		'aoi_bot_df_num',
		'aoi_bot_df_01',
		'aoi_bot_df_02',
		'aoi_bot_df_03',
		'aoi_bot_df_04',
		'aoi_bot_df_05',
		'aoi_bot_df_06',
		'aoi_bot_df_07',
		'aoi_bot_df_08',
		'aoi_bot_df_09',
		'aoi_bot_df_10',
		'aoi_bot_df_11',
		'aoi_bot_df_12',
		
		'element',
		'element_date',
		'quantity',
		'conting_t',
		'coting_inp',
		'receiver_team',
		'shipment_daily',
		'set_set',
		'faulty',
		'remarks',
		'type',
		'note',
		'wr_user',
		'marks',
		'mod_user',

	];

	public function searchableAs()
	{
		return 'main.search';
	}
}
