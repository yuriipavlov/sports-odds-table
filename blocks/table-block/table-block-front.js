import $ from 'jquery';

class SportsOddsTable {
	/**
	 Constructor
	 **/
	constructor() {
		this.build();
		this.filterEvents();
	}
	
	/**
	 Build page elements, plugins init
	 **/
	build() {
		
		// add custom select
		jcf.replaceAll();
	}
	
	/**
	 Set page events
	 **/
	filterEvents() {
		
		$('.sot-filter-btn__js').on('click', function (e) {
			
			let $block = $(this).closest('.sports-odds-table'),
				$loading = $block.find('.sot-loading'),
				$eventsContainer = $block.find('.sot-events'),
				data = {
					action: 'sports_odds_table_filter',
					sport: $block.find('select[name="sport"]').val(),
					region: $block.find('select[name="region"]').val(),
					market: $block.find('select[name="market"]').val(),
				};
			
			$.ajax({
				url: sportsOddsTable.ajaxUrl,
				data: data,
				type: 'POST',
				beforeSend: function () {
					
					$loading.show();
				},
				success: function (response) {
					
					if (response.success) {
						if (response.data.length > 0) {
							
							$eventsContainer.html(response.data);
							
						}
						
					}
				},
				complete: function () {
					$loading.hide();
				}
				
			});
			
			return false;
		});
		
	}
}

$(document).ready(() => {
	new SportsOddsTable();
});
