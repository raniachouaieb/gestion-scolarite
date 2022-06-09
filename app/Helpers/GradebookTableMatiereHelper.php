<?php
namespace App\Helpers;


use App\Models\MenusPicture;
use App\Models\Module;
use App\Models\Note;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as Image;

class GradebookTableMatiereHelper
{



    public static function tableNoteMatiere($module,$trimester,$eleve,$matiere){
        ob_start();
        ?>
        <table>

            <thead>
            <tr style="text-align: center; ">
                <th scope="col" style="font-family: DejaVu Sans, sans-serif; direction: rtl;">توصيات المدرّس (ة)</th>
                <th scope="col" style="font-family: DejaVu Sans, sans-serif;">معدّل المجال</th>
                <th scope="col" style="font-family: DejaVu Sans, sans-serif;">20/العدد </th>
                <th scope="col" style="background: #0cace099;font-family: DejaVu Sans, sans-serif; color: white;border-top-right-radius: 50px 50px;overflow: hidden;-webkit-box-shadow: 0 0 1px 0 rgba(0,0,0,.15);border: 0;">المادّة</th>
            </tr>

            </thead>
            <tbody style="text-align: center;border:2px">
            <?php $moyenneModule = \App\Models\moduleMoyenne::where('module_id',$module->id)->Where('trimestre',$trimester)->Where('student_id',$eleve->id)->first(); ?>
            <?php
            if (isset($moyenneModule)){
                $remarkModule = \App\Models\RemarqueModule::where('id',$moyenneModule->remarque_note_id)->first();
            }else{
                $remarkModule="--";
            }
            ?>
            <?php $nbrMat = \App\Models\Matiere::where('module_id',$module->id)->count(); ?>

            <tr>
                <td scope="col"style="font-family: DejaVu Sans, sans-serif;" rowspan="<?php print_r($nbrMat)?>"> <?php print_r($remarkModule['value'] ?? '--')?> </td>
                <td scope="col" rowspan=" <?php print_r($nbrMat)?>"> <?php print_r($moyenneModule->moyenne ?? '--')?></td>

                <?php  foreach($module->matieres as $matiere){
                $note = \App\Models\Note::where('matiere_id',$matiere->id)->Where('trimestre',$trimester)->Where('student_id',$eleve->id)->first();
                ?>

                <td scope="col">  <?php print_r( $note->note ?? '0' )?></td>
                <td scope="col" style="background: #0cace099 !important;font-family: DejaVu Sans, sans-serif; color: white;"><?php print_r($matiere->nom)?></td>
            </tr>
        <?php } ?>

            </tbody>
        </table>
        <?php
        return ob_get_clean();
    }
}
