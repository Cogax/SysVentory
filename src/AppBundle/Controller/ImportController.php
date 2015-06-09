<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class ImportController extends Controller
{
    /**
     * API for data import.
     *
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function importAction(Request $request) {

        // Check request http method
        if($request->getMethod() != 'POST') {
            //return new Response('Invalid method!', Response::HTTP_METHOD_NOT_ALLOWED);
            return new Response($request->getContent(), Response::HTTP_METHOD_NOT_ALLOWED);
        }

        // Check request http header "Content-Type"
        if($request->getContentType() != 'xml') {
            //return new Response('Invalid content-type: '.$request->getContentType(), Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
            return new Response($request->getContent(), Response::HTTP_UNSUPPORTED_MEDIA_TYPE);
        }

        if($request->getContent() == '') {
            return new Response($request->getContent(), Response::HTTP_NOT_FOUND);
        }

        // Check if XML is valid
        $xml = $request->getContent();
        $xsdFilename = $this->get('kernel')->locateResource("@AppBundle/Resources/schema/composition.xsd");
        if(!$this->get("app.xsd_validator")->isValid($xml, $xsdFilename)) {
            //return new Response('XML is not valid!', Response::HTTP_BAD_REQUEST);
            return new Response($request->getContent(), Response::HTTP_BAD_REQUEST);
        }

        // Store Composition
        if(!$this->get("app.composition_controller")->storeFromXML($xml)) {
            //return new Response('XML could not be converted into an object!', Response::HTTP_BAD_REQUEST);
            return new Response($request->getContent(), Response::HTTP_BAD_REQUEST);
        }
        return new Response("Success!");
    }
}
