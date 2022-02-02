<?php
// version downloaded from test1.redcap - Pete helped pull this together.
namespace Yale\PrintPDF;

use ExternalModules\AbstractExternalModule;

class PrintPDF extends AbstractExternalModule {

      public function printMe()
    {
        // Get the content of the blank PDF of all instruments
        $pdf_content = \REDCap::getPDF("1", "support_request_form");

        // print $pdf_content;
        $dir = sys_get_temp_dir();
        $dir = $dir . "/";
        $filename = "../ticketing_record1.pdf";

        // Save the PDF to a local web server directory
        $x = file_put_contents($filename, $pdf_content);

        // [ echo parameters to screen - if not printed or downloaded]
        print_r("<pre style=font-family:sans-serif;color:#00356b;font-size:2.2em;opacity:90%;text-align:left;margin-left:32px>");
        print_r(" Here is your filename: $filename " . "<br>");
        print_r(" This from: 'sys_get_temp_dir()' : " . $dir . "</br><p></p>" );
        print_r("bytes written: " . $x );
        print_r("</pre>");


       // print PDF

        // [ Method 3 ]
            //file path in server
         $file_path = $filename;
         // check if file exist in server
        // if(file_exists = true, then it will proceed to download, or else echo out some useful message.

         if( !file_exists($filename) ) die(" file not found dude...");
             header('Content-Description: File Transfer');
                // * force-download, as advertised, rather than opening in browser with "applicaiton /pdf"
             header('Content-Type: application/force-download');
             // header("Content-type: application/pdf");
             // * my Content-Length caused script to fail...weird...
             //header("Content-Length: " . filesize($file));
             header('Content-Disposition: attachment; filename="'.basename($file_path).'"');
             header('Expires: 0');
             header('Pragma: public');

             // Clear output buffer
             flush();
             readfile($file_path);
             exit();

    }


}

