<?php

namespace app\classes;

use Yii;
use app\models\Building;
use app\models\Fight;

/**
 * This is the model class for fighting simulation.
 *
 */

class Fight
{

	public function FightInformations($atk_land_id, $def_land_id, $atk_units, $game_data)
    {
		// Initialization
		$this->gameData				= $game_data;
    	$this->atk_max_units		= Fight::$AttakerMaxUnits;
    	$this->def_max_units		= Fight::$DefenderMaxUnits;
    	$this->bonus_fort			= Fight::$FortBonusUnits;
    	$this->bonus_camp			= Fight::$CampBonusUnits;
    	$this->camp_build_id 		= Building::$CampId;
    	$this->fort_build_id 		= Building::$FortId;
    	
    	// Attaker
    	$this->atk_land_id 			= $atk_land_id;
    	$this->atk_user_id 			= $this->gameData[$this->atk_land_id]->getGameDataUserId();
    	$this->atk_units_origin 	= $atk_units;
    	$this->atk_units 			= $this->atk_units_origin;
    	$this->atk_have_camp		= (in_array($this->camp_build_id, $this->gameData[$this->atk_land_id]->getGameDataBuildings()))? true : false;
    	$this->atk_max_unit			= ($this->atk_units >= $this->atk_max_units)? $this->atk_max_units : $this->atk_units;
    	$this->atk_max_unit_final	= $this->atk_have_camp*$this->bonus_camp + $this->atk_max_units;
    	
    	// Defender
    	$this->def_land_id 			= $def_land_id;
    	$this->def_user_id 			= $this->gameData[$this->def_land_id]->getGameDataUserId();
    	$this->def_units_origin 	= $this->gameData[$this->def_land_id]->getGameDataUnits();
    	$this->def_units 			= $this->atk_units_origin;
    	$this->def_have_camp		= (in_array($this->fort_build_id, $this->gameData[$this->def_land_id]->getGameDataBuildings()))? true : false;
    	$this->def_max_unit			= ($this->def_units >= $this->def_max_units)? $this->def_max_units : $this->def_units;
    	$this->def_max_unit_final	= $this->buildings_of_def_user*$this->bonus_fort + $this->def_max_units;
    	
    	// Init fight
    	$this->nb_fight 			= 0;
    	$this->atk_thimble_form 	= array();
    	$this->def_thimble_form		= array();
    	
      }

    public function FightStart()
    {
    	

    	/* Boucle qui se terminera quand un des camps aura perdu */
    	while($this->atk_current_units > 0 && $this->def_current_units > 0)
    	{
    		/* Initialisation */
    		$this->atk_thimble_array	= array();
    		$this->def_thimble_array	= array();
    		$this->atk_fighting_units	= 0;
			$this->def_fighting_units	= 0;
			$this->atk_thimble_form		.= "/";
			$this->def_thimble_form		.= "/";
			$this->atk_units_form		.= "/";
			$this->def_units_form		.= "/";

    		/* Attaquant */
    		// On détermine par rapport au max, le nombre d'unités dispo
    		if($this->atk_current_units > $this->max_unit_atk){
    		$this->atk_fighting_units = $this->max_unit_atk;}else{
    		$this->atk_fighting_units = $this->atk_current_units;}

    		// Lancé
			for($i=0; $i < $this->atk_fighting_units; $i++){array_push($this->atk_thimble_array, rand(1, 6));}

			// Rangement
			rsort($this->atk_thimble_array);	

			
			/* Défenseur */
			// On détermine par rapport au max, le nombre d'unités dispo
    		if($this->def_current_units > $this->max_unit_def){
    		$this->def_fighting_units = $this->max_unit_def;}else{
    		$this->def_fighting_units = $this->def_current_units;}

    		// Lancé
			for($i=0; $i < $this->def_fighting_units; $i++){array_push($this->def_thimble_array, rand(1, 6));}

			// Rangement
			rsort($this->def_thimble_array);	

			// Reg units
			$this->atk_units_form	.= $this->atk_current_units;
			$this->def_units_form	.= $this->def_current_units;

			// Reg thimbles
			for ($i=0; $i < count($this->atk_thimble_array); $i++) { 
	    		$this->atk_thimble_form.= $this->atk_thimble_array[$i].";";
		    }
		    
		    for ($i=0; $i < count($this->def_thimble_array); $i++) { 
		    	$this->def_thimble_form.= $this->def_thimble_array[$i].";";
		    } 


			/* Résultat */
			$max_fight = min($this->atk_fighting_units, $this->def_fighting_units)-1;
			// Pour chaque dés
			for($i=0;$i <= $max_fight; $i++){

				// L'attaquant gagne
				if($this->atk_thimble_array[$i] > $this->def_thimble_array[$i] 
					&& $this->atk_thimble_array[$i] !="" 
					&& $this->def_thimble_array[$i] !=""){
					$this->def_current_units--;
				// Le défenseur gagne	
				}else{
					$this->atk_current_units--;}
			}

			$this->nb_fight++;
    	}

    	if($this->atk_units_form == null){$this->atk_units_form = "";}
	    if($this->def_units_form == null){$this->def_units_form = "";}

    	// L'attaquant gagne
    	if($this->def_current_units == 0){
    		$this->conquest = 1;
    	}else{
	    	$this->conquest = 0;
	    }

    	/* Enregistrement des resultats dans la BD */
    	//$this->FightUpdate();
    	// add action

    }

    private function FightUpdate()
    {
    	// L'attaquant gagne
    	if($this->conquest == 1){
	    	// Attaquant
	    	$atk_final = $this->atk_land_info['units'] - $this->origin_atk_units;
	    	Yii::$app->db->createCommand()
	            ->update("game_data", [
	            	'units'           	=> $atk_final,
	            	],[
	            	'game_id'           => $this->game_id,
	            	'land_id'           => $this->atk_land_id,
	            	])
	            ->execute();

	        // Defenseur
	    	Yii::$app->db->createCommand()
	            ->update("game_data", [
	            	'units'           	=> $this->atk_current_units,
	            	'user_id'			=> $this->atk_land_info['user_id'],
	            	],[
	            	'game_id'           => $this->game_id,
	            	'land_id'           => $this->def_land_id,
	            	])
	            ->execute();

        // Le défenseur gagne
	    }else{
	    	// Attaquant
	    	$atk_final = $this->atk_land_info['units'] - $this->origin_atk_units;
	    	Yii::$app->db->createCommand()
	            ->update("game_data", [
	            	'units'           	=> $atk_final,
	            	],[
	            	'game_id'           => $this->game_id,
	            	'land_id'           => $this->atk_land_id,
	            	])
	            ->execute();

	        // Defenseur
	    	Yii::$app->db->createCommand()
	            ->update("game_data", [
	            	'units'           	=> $this->def_current_units,
	            	],[
	            	'game_id'           => $this->game_id,
	            	'land_id'           => $this->def_land_id,
	            	])
	            ->execute();
	    }

	    /* Add in Fight-Data DB */
	    Yii::$app->db->createCommand()->insert("fight_data", [
            'game_id'           => $this->game_id,
            'atk_user_id'		=> $this->atk_land_info['user_id'],
            'def_user_id'		=> $this->def_land_info['user_id'],
            'atk_land_id'		=> $this->atk_land_info['land_id'],
            'def_land_id'		=> $this->def_land_info['land_id'],
            'atk_lost_unit'		=> $this->atk_units - $this->atk_current_units,
            'def_lost_unit'		=> $this->def_land_info['units'] - $this->def_current_units,
            'atk_units'			=> $this->atk_units_form,
            'def_units'			=> $this->def_units_form,
            'thimble_atk'		=> $this->atk_thimble_form,
            'thimble_def'		=> $this->def_thimble_form,
            'atk_nb_units'		=> $this->atk_units,
            'def_nb_units'		=> $this->def_base_units,
            'time'              => time(),
            'turn_id'			=> $this->current_turn_info['id'],
            'conquest'			=> $this->conquest,
        ])->execute();
    }


    public function FightResult()
    {
    	return array(
    		'atk_land_id'		=> $this->atk_land_info['land_id'],
            'def_land_id'		=> $this->def_land_info['land_id'],
    		'nb_fight' 			=> $this->nb_fight,
    		'def_engage_units' 	=> $this->def_land_info['units'], 
    		'def_result_units' 	=> $this->def_current_units,
    		'atk_engage_units' 	=> $this->atk_units, 
    		'atk_result_units' 	=> $this->atk_current_units,
    		//'fight_data_id' 	=> FightData::LastFightGameDataInformations($this->game_id)['id'],
    		'conquest' 			=> $this->conquest,
    		'thimble_atk'		=> $this->atk_thimble_form,
            'thimble_def'		=> $this->def_thimble_form,
            'atk_units'			=> $this->atk_units_form,
            'def_units'			=> $this->def_units_form,
    	);
    }
} 