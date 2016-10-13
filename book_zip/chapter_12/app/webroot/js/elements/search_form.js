function checkSearchTerm() {

    if ( $( 'MfSearchProcessSearchTerm' ).value == '' ) {
        alert( 'Please enter a search term.' );
        return false;
    }
    
    return true;
}