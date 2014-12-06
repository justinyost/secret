<?php
/**
 * RandomizePeople
 *
 * Randomize an array of people, ensuring no one element in the shuffled array
 * is paired with the same element in the unshuffled array
 */
class RandomizePeople {

	/**
	 * randomize an array of People, ensuring no shuffled person is matched with
	 * themselves
	 *
	 * @param  array  $shuffledPeople   the array of shuffled people
	 * @param  array  $unshuffledPeople the array of unshuffled people
	 * @return array
	 */
	public function randomize($shuffledPeople = array(), $unshuffledPeople = array()) {
		$shuffledPeople = $this->shuffle($shuffledPeople);
		$noOneMatches = true;
		foreach($shuffledPeople as $key => $data) {
			if ($data['name'] === $unshuffledPeople[$key]['name']) {
				$noOneMatches = false;
			}
		}

		if(!$noOneMatches && count($shuffledPeople) > 1) {
			return $this->randomize($shuffledPeople, $unshuffledPeople);
		}

		return $shuffledPeople;
	}

	/**
	 * shuffle an array using the Fisher-Yates algorthim
	 *
	 * @param  array $array unshuffled array
	 * @return array
	 */
	protected function shuffle(array $array = array()){
		$i = count($array);
		while(--$i){
			$j = mt_rand(0,$i);
			if($i != $j){
				// swap items
				$tmp = $array[$j];
				$array[$j] = $array[$i];
				$array[$i] = $tmp;
			}
		}
		return $array;
	}
}
