jQuery( function( $ ) {
    $( document ).ready(function() {
      
      $('#cart-button').on( "click", function(e) {
        e.preventDefault();
        e.stopPropagation();
        $( '.cart-dialog' ).toggleClass( 'cart-dialog--active' );
      });
      $('.cart-dialog').on( "click", function(e) {
        e.stopPropagation();
      });
      $(document).on( "click", function() {
        $('.cart-dialog--active').removeClass( 'cart-dialog--active' );
      });
  
    }(jQuery));
});