<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ImportController extends Controller
{
    public function importAction(Request $request) {

        // check request method
        if($request->getMethod() != 'POST') {
            return new Response('Invalid method!', Response::HTTP_METHOD_NOT_ALLOWED);
        }

        // check content type http header
        if($request->getContentType() != 'xml') {
            return new Response('Invalid content-type: '.$request->getContentType(), Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
        }

        // ceck if xml is valid
        $xml = $request->getContent();
        $xsdFilename = $this->get('kernel')->locateResource("@AppBundle/Resources/schema/composition.xsd");
        if(!$this->get("app.xsd_validator")->idValid($xml, $xsdFilename)) {
            return new Response('XML is not valid!', Response::HTTP_BAD_REQUEST);
        }

        // store
        $this->get("app.composition_controller")->storeFromXML($xml);

        return new Response("Success!");
    }
}
