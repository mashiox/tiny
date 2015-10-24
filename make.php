<?php

if ( isset($_POST['URI']) && filter_var($_POST['URI'], FILTER_VALIDATE_URL) ){
    require_once 'include/Config.php';
    require_once 'include/Database.php';
    require_once 'include/URI.php';
    require_once $GLOBALS['HTMLPURE'];
    $pure = new HTMLPurifier(HTMLPurifier_Config::createDefault());
    $cleanURI = $pure->purify($_POST['URI']);
    $URI = new URI($cleanURI);
    $db = new Database($GLOBALS['host'], $GLOBALS['user'], 
        $GLOBALS['password'], $GLOBALS['database']);
    $exists = $db->getRecord( $URI->getHex() );
    if ( $exists === "" || $exists === NULL ){
        $retval = ( $db->setRecord($URI->getHex(), $URI->getURI()) == TRUE ?
            json_encode(array('status'=>  1, 'tiny'=>$GLOBALS['TINY_PATH'].$URI->getHash(),
                'hash'=>$URI->getHash(), 'uri'=>$URI->getURI())) :
            json_decode(array('status'=> -2, 'error'=> "Database Error"))
        );
    }
    else
        $retval = json_encode (array('status'=> 2, 'tiny'=>$GLOBALS['TINY_PATH'].$URI->getHash(), 
            'hash'=>$URI->getHash(), 'uri'=>$URI->getURI()));
    echo $retval;
}
else {
    echo json_encode(array(
        'status' => -1,
        'error' => "Invalid URI"
    ));
}

?>

