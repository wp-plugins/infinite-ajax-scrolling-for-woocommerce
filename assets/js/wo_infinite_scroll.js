(function ($, window, document) 
{
    "use strict";

        var scroll_options = $.extend(
			{
				scroll_item_selector   : false,               
				scroll_content_selector: false,
                scroll_next_selector   : false,
				is_shop        : false,
				loader         : false  
            }, 
			{
			'scroll_item_selector'      : item_Selector,	           
            'scroll_content_selector'   : content_Selector,
            'scroll_next_selector'      : next_Selector,
			'is_shop'           : true,  
			'loader'            : image_loader
			}
			),
            under_loading  = false,
            loading_finished = false,
            target_url  = $( scroll_options.scroll_next_selector ).attr( 'href' ); 

		if( !$( scroll_options.scroll_next_selector ).length  && !$( scroll_options.scroll_item_selector ).length && !$( scroll_options.scroll_content_selector ).length ) 
		{
            loading_finished = true;
        }
		
		if($( scroll_options.scroll_next_selector ).length == 0){ loading_finished = true; return; }
        
		

        var first_product_unit  = $( scroll_options.scroll_content_selector ).find( scroll_options.scroll_item_selector ).first(),
            columns = first_product_unit.nextUntil( '.first', scroll_options.scroll_item_selector ).length + 1;

		
		
        var call_ajax = function () 
		{

            var last_product_unit   = $( scroll_options.scroll_content_selector ).find( scroll_options.scroll_item_selector ).last();
            
            if( scroll_options.loader )
            
				$( scroll_options.scroll_content_selector ).after( '<div class="scroll-loader"><center><img src="' + scroll_options.loader + '"/></center><br></div>' );
			
			under_loading = true;
            
            $.ajax({
               
                url         : target_url,
                dataType    : 'html',
                success     : function (response) {

                    var obj  = $( response),
                        product_unit = obj.find( scroll_options.scroll_item_selector ),
                        next = obj.find( scroll_options.scroll_next_selector );

                    if( next.length ) 
					{
                        target_url = next.attr( 'href' );
                    }
                    else 
					{
                        loading_finished = true;
                    } 
                    
                    if( ! last_product_unit.hasClass( 'last' ) && scroll_options.is_shop ) 
					{
                        position_product_unit( last_product_unit, columns, product_unit );
                    }

                     product_unit.css({
                        'opacity':'0'
                     });
					
                    last_product_unit.after( product_unit );

                    $( '.scroll-loader' ).remove();
					
					product_unit.fadeTo(2000,1,function() { under_loading = false;});

                }
            });
        };
       
        var position_product_unit = function( last, columns, product_unit ) {

            var off_set  = ( columns - last.prevUntil( '.last', scroll_options.scroll_item_selector ).length ),
                loop    = 0;

            product_unit.each(function () {

                var y = $(this);
                loop++;

                y.removeClass('first');
                y.removeClass('last');

                if ( ( ( loop - off_set ) % columns ) === 0 ) 
				{
                    y.addClass('first');
                }
                else if ( ( ( loop - ( off_set - 1 ) ) % columns ) === 0 ) 
				{
                    y.addClass('last');
                }
            });
        };
       
        $( window ).on( 'scroll touchstart', function (){
            var y       = $(this),
                off_set  = $( scroll_options.scroll_item_selector ).last().offset();

            if ( ! under_loading && ! loading_finished && y.scrollTop() >= Math.abs( off_set.top - ( y.height() - 150 ) ) ) 
			{
                call_ajax();
            }
        });
	
})( jQuery, window, document );

