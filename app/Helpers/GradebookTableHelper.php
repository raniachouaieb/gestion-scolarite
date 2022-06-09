<?php
namespace App\Helpers;


use App\Models\MenusPicture;
use App\Models\Module;
use App\Models\Note;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class GradebookTableHelper
{



    public static function tableMaxMin($nbrMaxMin){
        ob_start();
        ?>

        <table  class="table">
        <thead>
        <tr style="text-align: center; ">
            <th scope="col" style="font-family: DejaVu Sans, sans-serif; direction: rtl;">أدنى عدد بالقسم</th>
            <th scope="col" style="font-family: DejaVu Sans, sans-serif;">أعلى عدد بالقسم</th>

        </tr>
        </thead>
            <tbody>

               <?php foreach($nbrMaxMin as $tM){
                   ?>
            <tr>
            <?php    foreach($tM as $tMin){?>
               <td>
                <?php print_r( $tMin) ?>
               </td>

            <?php }     ?>

           </tr>
           <?php }     ?>
            </tbody>
        </table>
        <?php
        return ob_get_clean();
    }
}
