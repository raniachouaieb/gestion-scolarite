<?php
namespace App\Helpers;


use App\Models\MenusPicture;
use App\Models\Module;
use App\Models\Note;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class GradebookTableMoyenHelper
{



    public static function tableMaxMinMoyenne($nbrMaxMin,$basicmoyenne,$moyenne,$tabmaxminmoyG){
        ob_start();
        ?>


        <table  class="table">
        <thead>
        <tr style="text-align: center;color: white; ">

            <th scope="col" style="background-color: #0cace075 !important;font-family: DejaVu Sans, sans-serif; direction: rtl;">أدنى معدل بالقسم</th>
            <th scope="col" style="background-color: #0cace075 !important;font-family: DejaVu Sans, sans-serif;">أعلى معدل بالقسم</th>
            <th scope="col" style="font-family: DejaVu Sans, sans-serif; direction: rtl;background-color: #0cace099 !important;">معدل الثلاثي</th>
        </tr>
        <tr style="color: white; text-align: center; ">
            <th scope="col" style="background-color: #0cace075 !important;font-family: DejaVu Sans, sans-serif; direction: rtl;">معدل المواد الأساسيّة</th>
            <th scope="col" style="background-color: #0cace075 !important;font-family: DejaVu Sans, sans-serif;">معدل المواد الأساسيّة</th>
            <th scope="col" style="font-family: DejaVu Sans, sans-serif;background-color: #0cace099 !important;">معدل المواد الأساسيّة</th>

        </tr>
        </thead>
            <tbody>
            <tr style="text-align: center;">
                <?php foreach($tabmaxminmoyG as $moyG){
                    ?>

                    <?php    foreach($moyG as $tmoyG){?>
                        <td>
                            <?php print_r( $tmoyG) ?>
                        </td>

                    <?php }     ?>


                <?php }     ?>
                <td>    <?php print_r($basicmoyenne ) ?></td>
            </tr>


            <tr style="text-align: center;font-weight: bold;color: white; ">
                <td scope="col" style="background-color: #0cace075 !important;font-family: DejaVu Sans, sans-serif; direction: rtl;">معدل المواد العام</td>
                <td scope="col" style="background-color: #0cace075 !important;font-family: DejaVu Sans, sans-serif;">معدل المواد العام</td>
                <td scope="col" style="background-color: #0cace099 !important;font-family: DejaVu Sans, sans-serif;">معدل المواد العام</td>

            </tr>
            <tr style="text-align: center;">
                <?php foreach($nbrMaxMin as $tM){
                    ?>

                    <?php    foreach($tM as $tMin){?>
                        <td>
                            <?php print_r( $tMin) ?>
                        </td>

                    <?php }     ?>


                <?php }     ?>
                <td>    <?php print_r( $moyenne) ?></td>
            </tr>
            </tbody>
        </table>
        <table class="table">
            <thead>
            <tr style="background-color: #0cace099 !important;text-align: center;color:white">
                <th>
                    الشهادة
                </th>
            </tr>
            </thead>
            <tbody>
            <tr style="font-weight: bold; text-align: center;">
                <?php if($moyenne >= 16){ ?>
                <td>
                    شهادة شكر
                </td>
              <?php }
                elseif ($moyenne<16){
                ?>
                    <td>
                        شهادة  تشجيع
                    </td>
                    <?php }?>
            </tr>
            </tbody>
        </table>

        <?php
        return ob_get_clean();
    }
}
