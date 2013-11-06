<?
	class TaxType{
		public $name;
		public $taxName;
		public $options = [];
		public $labels = [];
		public $types = [];

		public function __construct($name, $taxName, $types = [], $options = [], $labels = [], $level = 0){

			$default_labels = [
				"plural" => ucwords($this->name),
				"single" => ucwords($this->name)
			];

			$default_types = [
				"post"
			];

			$defaults = [
				'hierarchical' => true,
		    	'label' => $default_labels["single"],
				'show_ui' => true,
				'query_var' => true,
				'rewrite' => false,
			];

			$this->name = $name;
			$this->options = $options + $defaults;
			$this->labels = $labels + $default_labels;
			$this->types = $types + $default_types;
			$this->taxName = $taxName;

			$this->options["labels"] = $this->labels + $this->get_labels();

			add_action("init", array($this, "register_tax", $level));
		}

		protected function register_tax(){
			register_taxonomy($this->taxName, $this->types, $this->options);
		}

		protected function get_labels(){
			return [
				'name' => $this->labels["plural"],
		        'singular_name' => $this->labels["single"],
		        'add_new' => 'Add New',
		        'add_new_item' => 'Add New ' . $this->labels["single"],
		        'edit_item' => 'Edit ' . $this->labels["single"],
		        'new_item' => 'New ' . $this->labels["single"],
		        'view_item' => 'View ' . $this->labels["single"],
		        'search_items' => 'Search ' . $this->labels["single"],
		        'not_found' => 'No ' . $this->labels["plural"] . ' found',
		        'not_found_in_trash' => 'No ' . $this->labels["plural"] . ' found in Trash',
		        'parent_item_colon' => 'Parent ' . $this->labels["single"] . ':',
		        'menu_name' => $this->labels["plural"]
			];
		}
	}
?>