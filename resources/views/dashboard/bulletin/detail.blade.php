@extends('layouts.app-admin')
{{-- Page title --}}
@section('title',$title)


@section('styles')
    <style>
        body { font-family: DejaVu Sans, sans-serif; }

            div.headTable {
                border-top-right-radius: 80px 80px;
                overflow: hidden;
                -webkit-box-shadow: 0 0 1px 0 rgba(0, 0, 0, .15);
                background-color: #0cace099 !important;
                padding: 11px;
                padding-left: 39%;

            }
.alignement{
    left: 50%;
}
        table tr.table-tr-remove:first-child{
            border-top: 3px solid #f46a6a;
        }
        .cdn-browser {
            background: #f4f5f9;
            height: 100%
        }

        .cdn-browser .btn-pick-files {
            position: relative
        }

        .cdn-browser .btn-pick-files input {
            opacity: 0;
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0
        }

        .cdn-browser .icon-loading {
            top: 4px;
            font-size: 20px;
            margin-right: 10px;
            position: relative;
            display: none
        }

        .cdn-browser .icon-loading.active {
            display: inline-block
        }

        .cdn-browser .files-nav {
            padding: 9px 13px;
            border-bottom: 1px solid #dadee0;
            background: #fff
        }

        .cdn-browser .files-nav .filter-item {
            padding-right: 20px
        }

        .cdn-browser .files-nav .btn,.cdn-browser .files-nav .form-control {
            height: 34px;
            font-size: 14px;
            line-height: normal;
            padding: 3px 12px
        }

        .cdn-browser .files-list {
            flex-grow: 1;
            overflow: auto;
            padding: 15px
        }

        .cdn-browser .files-list .view-grid {
            display: flex;
            flex-wrap: wrap;
            margin: 0 -10px
        }

        .cdn-browser .files-list .total-text {
            padding: 0 10px
        }

        .cdn-browser .files-list .view-grid .file-item {
            flex-shrink: 0;
            width: 12.5%;
            padding: 0 10px;
            margin-bottom: 20px
        }

        .cdn-browser .files-list .view-grid .file-item .inner {
            position: relative;
            border: 1px solid #dadee0;
            cursor: pointer;
            height: 100%;
            border-radius: 2px;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
            -webkit-user-select: none
        }

        .cdn-browser .files-list .view-grid .file-item .inner.active:before {
            content: "";
            position: absolute;
            top: -4px;
            left: -4px;
            right: -4px;
            bottom: -4px;
            border: 4px solid #007bff;
            border-radius: 2px
        }

        .cdn-browser .files-list .view-grid .file-item .inner.active .file-checked-status {
            position: absolute;
            top: 3px;
            right: 3px;
            border-radius: 50%;
            background: #007bff;
            height: 24px;
            width: 24px;
            display: flex;
            align-content: center;
            justify-content: center
        }

        .cdn-browser .files-list .view-grid .file-item .inner.active .file-checked-status svg {
            fill: #fff;
            width: 18px
        }

        .cdn-browser .files-list .view-grid .file-item .inner .file-thumb img {
            max-width: 100%
        }

        .cdn-browser .files-list .view-grid .file-item.is-image .inner .file-thumb img {
            -o-object-fit: cover;
            object-fit: cover;
            height: 170px
        }

        .cdn-browser .files-list .view-grid .file-item.not-image .inner .file-thumb img {
            padding-top: 27px;
            height: auto
        }

        .cdn-browser .files-list .view-grid .file-item .inner .file-thumb {
            text-align: center
        }

        .cdn-browser .files-list .view-grid .file-item .file-name {
            padding: 7px;
            position: absolute;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0,0,0,.6);
            font-size: 14px;
            height: 54px;
            overflow: hidden;
            text-overflow: ellipsis;
            color: #fff
        }

        .cdn-browser .browser-actions {
            background: #fff;
            border-top: 1px solid #dadee0;
            padding: 10px
        }

        .cdn-browser .count-selected {
            color: #007bff;
            font-weight: 700;
            font-size: 14px
        }

        .cdn-browser .clear-selected {
            color: red;
            font-size: 14px;
            cursor: pointer
        }

        .cdn-browser .no-files-text {
            padding: 20px;
            font-size: 20px;
            color: red
        }

        .cdn-browser .upload-new .filepond--root {
            margin-bottom: 0;
            background-color: #fff;
            border-bottom: 1px solid #dadee0
        }

        .cdn-browser .upload-new .filepond--panel-root {
            border-radius: 0;
            background-color: #fff;
            border-bottom: 1px solid #dadee0
        }

        @media (max-width: 1365px) {
            .cdn-browser .files-list .view-grid .file-item {
                width:14.2%
            }
        }

        @media (max-width: 1100px) {
            .cdn-browser .files-list .view-grid .file-item {
                width:14.2%
            }
        }

        @media (max-width: 991px) {
            .cdn-browser .files-list .view-grid .file-item {
                width:25%
            }
        }

        @media (max-width: 600px) {
            .cdn-browser .files-list .view-grid .file-item {
                width:50%
            }
        }

        .cdn-browser .browser-actions .col-left {
            display: flex
        }

        .cdn-browser .browser-actions .col-left .control-remove {
            margin-right: 15px;
            padding-top: 3px
        }

        .cdn-browser .browser-actions .col-right .btn {
            margin-top: 3px
        }

        #cdn-browser-modal {
            overflow: hidden;
            z-index: 2051
        }

        #cdn-browser-modal .modal-dialog {
            height: 100%;
            padding-bottom: 55px;
            margin-left: auto;
            margin-right: auto
        }

        #cdn-browser-modal .modal-dialog .modal-content {
            height: 100%
        }

        .cdn-browser.is_loading {
            position: relative
        }

        .cdn-browser.is_loading:before {
            display: block!important;
            right: 0;
            position: absolute;
            background: #fff;
            left: 0;
            top: 52px;
            z-index: 11;
            opacity: .8;
            content: "";
            bottom: 0
        }

        .cdn-browser.is_loading:after {
            content: "";
            display: block!important;
            font: normal normal normal 14px/1 FontAwesome;
            right: 0;
            position: absolute;
            left: 0;
            top: 50%;
            z-index: 15;
            text-align: center;
            color: #131d29;
            font-size: 50px;
            margin-top: -20px
        }
    </style>
    <style>

        .dungdt-upload-box {
            position: relative;
        }

        .dungdt-upload-box .upload-box {
            background: #fafbfc;
            text-align: center;
            border: 1px solid rgba(195, 207, 216, 0.3);
            padding: 30px 20px;
            transition: all 0.2s;
        }

        .dungdt-upload-box .upload-box svg {
            width: 120px;
            height: 100px;
            margin-bottom: 15px;
        }

        .dungdt-upload-box .upload-box:hover {
            border: 1px solid #c3cfd8;
        }

        .dungdt-upload-box .attach-demo {
            background: #fafbfc;
            text-align: center;
            border: 1px solid rgba(195, 207, 216, 0.3);
            transition: all 0.2s;
            cursor: pointer;
            overflow: hidden;
            position: relative;
        }

        .dungdt-upload-box .attach-demo img {
            max-width: 100%;
        }

        .dungdt-upload-box .upload-actions,
        .dungdt-upload-box .attach-demo {
            display: none;
        }

        .dungdt-upload-box.active .upload-actions {
            display: flex;
        }

        .dungdt-upload-box.active .upload-box {
            display: none;
        }

        .dungdt-upload-box.active .attach-demo {
            display: block;
            padding: 20px;
        }

        .dungdt-upload-box .delete {
            color: white;
            position: absolute;
            top: 15px;
            right: 15px;
            cursor: pointer;
            display: none;
        }

        .dungdt-upload-box .delete i {
            color: white;
        }

        .dungdt-upload-box:hover .delete {
            display: block;
        }

    </style>
@stop
@section('content')
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('accueil')}}">Accueil</a></li>
                <li class="breadcrumb-item active" aria-current="page"><a href="{{route('bulletin.admin.index')}}">Liste elèves</a></li>

                <li class="breadcrumb-item active" aria-current="page">Détail Note</li>
            </ol>
        </nav>

    <div class="card page-body">
        <div class="card-body">
        <form action="{{route('bulletin.admin.store', ['id'=>($bulletin->id) ? $bulletin->id : '-1']) }}" enctype="multipart/form-data"  method="post" class="notSendAjax needs-validation" novalidate>
        @csrf
        <input name="student_id" type="hidden" value="{{$eleve->id}}"   >
        <input name="id" type="hidden" value="{{$bulletin->id}}"   >
        <input name="trimester" type="hidden" value="{{$bulletin->trimestre}}"   >
        <input name="path" type="hidden" value="{{$bulletin->path}}"   >

            @include('includes.alerts.flash')
            <div class="row print-hide">
                <div class="col-md-12">

                        <div class="headers-line mt-md"><i class="fas fa-user-check"></i> {{__('Détail elève')}}</div>

                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="first_name">{{__("Nom")}}</label>
                                        <input type="text" value="{{old('nomEleve',$eleve->nomEleve)}}" name="first_name" disabled class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="last_name">{{__("Prénom")}}</label>
                                        <input type="text" value="{{old('prenomEleve',$eleve->prenomEleve)}}" name="last_name" disabled class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">

                                    <div class="form-group">
                                        <label for="birth_day">{{ __('Date Naissance')}}</label>
                                        <input type="date" value="{{\Carbon\Carbon::parse(old('birth',$eleve->birth))->format('Y-m-d')}}" disabled placeholder="{{ __('birth_day')}}" name="birth_day" class="form-control has-datepicker input-group date" >
                                    </div>
                                </div>
                            </div>
                        </div>
{{--                    <div class="headers-line mt-md"><i class="fas fa-user-check"></i> {{__('Publier')}}</div>--}}

{{--                    <div class="card-body">--}}
{{--                        <div>--}}
{{--                            <label for="status1"><input   {{ ($bulletin->status=="1")? "checked" : "" }}  type="radio" name="status" value="1"> Publish--}}
{{--                            </label></div>--}}
{{--                        <div>--}}
{{--                            <label for="status0"><input {{ ($bulletin->status=="0")? "checked" : "" }}  type="radio" name="status" value="0"> Draft--}}
{{--                            </label></div>--}}
{{--                        <div class="text-right">--}}
{{--                            <button class="btn btn-primary" type="submit"><i class="fa fa-save"></i> Enregistrer</button>--}}
{{--                        </div>--}}
{{--                    </div>--}}
{{--                </div>--}}


{{--                        <div class="headers-line mt-md print-hide"><i class="fas fa-user-check"></i> {{__('Gradebook details')}}</div>--}}
{{--                        <div class="card-body print-hide">--}}
{{--                            <div class="row">--}}
{{--                                <div class="col-md-5">--}}
{{--                                    <input type="hidden" name="idfile" value="ccc" id="idfile" class="idfile">--}}
{{--                                    <input type="hidden" name="pathfile" value="{{isset($bulletin->bulletinFile)? $bulletin->bulletinFile->file_path:'' }}" id="pathfile" class="pathfile">--}}
{{--                                    <div class="form-group">--}}



{{--                                        <div class="form-group @error('path') is-invalid @enderror" >--}}
{{--                                            {!! \App\Helpers\BulletinFileHelper::fieldUploads('path',old('path', isset($bulletin->bulletinFile)? $bulletin->bulletinFile->id:'')) !!}--}}

{{--                                        </div>--}}

{{--                                        @error('path')--}}
{{--                                        <span class="invalid-feedback" style="border-color: #fbe1e3;color: #e73d4a;float: left;padding-bottom: 10px; " role="alert">--}}
{{--                                            <strong>{{ $message }}</strong>--}}
{{--                                        </span>--}}
{{--                                        @enderror--}}
{{--                                        <br>--}}
{{--                                        <input  class="btn btn-primary" type="button" value="Preview" onclick="PreviewImage();" style=" float: right; " />--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                                <div class="col-md-6">--}}

{{--                                    <div class="form-group">--}}

{{--                                        <iframe id="viewer" frameborder="0" scrolling="no" width="400" height="600"></iframe>                                    </div>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

            </form>
        </div>
    </div>

            <div class="row">
                <div class="col-md-8">
                    <div class="headers-line mt-md"><i class="fas fa-user-check"></i> {{__('Bulletin')}}</div>
                </div>
                 <div class="col-md-4">
                     <a href="javascript:void(0)" style=" float: right; " class="btn btn-primary" onclick="printJS({ printable: 'bulletinTable', type: 'html', targetStyles: ['*']})"><i class="fa fa-print" aria-hidden="true"></i>  Impress</a>
                </div>
            </div>

         <div id="bulletinTable">

            @include('dashboard.bulletin.gradebookNote')
         </div>

    <div id="cdn-browser-modal" class="modal fade">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div id="cdn-browser" class="cdn-browser d-flex flex-column" v-cloak :class="{is_loading:isLoading}">
                    <div class="files-nav flex-shrink-0">
                        <div class="d-flex justify-content-between">
                            <div class="col-left d-flex align-items-center">

                                <div class="filter-item">
                                    <input type="text" placeholder="{{__("Search file name....")}}" class="form-control" v-model="filter.s" @keyup.enter="filter.page = 1;reloadLists()">
                                </div>
                                <div class="filter-item">
                                    <button class="btn btn-default" @click="filter.page = 1;reloadLists()">
                                        <i class="fa fa-search"></i> {{__("Search")}}</button>
                                </div>
                                <div class="filter-item">
                                    <small><i>{{__("Total")}}: @{{total}} {{__("files")}}</i></small>
                                </div>
                            </div>
                            <div class="col-right">
                                <i class="fa-spin fa fa-spinner icon-loading active" v-show="isLoading"></i>
                                <button class="btn btn-success btn-pick-files">
                                    <span><i class="fa fa-upload"></i> {{__("Upload")}}</span>
                                    <input multiple type="file" name="files[]" ref="files">

                                </button>

                            </div>
                        </div>
                    </div>
                    <div class="upload-new" v-show="showUploader" display="none">
                        <input type="file" name="filepond[]" class="my-pond">

                    </div>
                    <div class="files-list">
                        <div class="files-wraps " :class="'view-'+viewType">
                            <file-item v-for="(file,index) in files" :key="index" :view-type="viewType" :selected="selected" :file="file" v-on:select-file="selectFile"></file-item>
                        </div>
                        <p class="no-files-text text-center" v-show="!total && apiFinished" style="display: none">{{__("No file found")}}</p>
                        <div class="text-center" v-if="totalPage > 1">
                            <nav aria-label="Page navigation example">
                                <ul class="pagination">
                                    <li class="page-item" :class="{disabled:filter.page <= 1}">
                                        <a class="page-link" v-if="filter.page <=1">{{__("Previous")}}</a>
                                        <a class="page-link" href="#" v-if="filter.page > 1" v-on:click="changePage(filter.page-1,$event)">{{__("Previous")}}</a>
                                    </li>
                                    <li class="page-item" v-if="p >= (filter.page-3) && p <= (filter.page+3)" :class="{active: p == filter.page}" v-for="p in totalPage" @click="changePage(p,$event)">
                                        <a class="page-link" href="#">@{{p}}</a></li>
                                    <li class="page-item" :class="{disabled:filter.page >= totalPage}">
                                        <a v-if="filter.page >= totalPage" class="page-link">{{__("Next")}}</a>
                                        <a href="#" class="page-link" v-if="filter.page < totalPage" v-on:click="changePage(filter.page+1,$event)">{{__("Next")}}</a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                    <div class="browser-actions d-flex justify-content-between flex-shrink-0" v-if="selected.length">
                        <div class="col-left" v-show="selected.length">
                            <div class="control-remove" v-if="selected && selected.length">
                                <button class="btn btn-danger" @click="removeFiles">{{__("Delete file")}}</button>
                            </div>
                            <div class="control-info" v-if="selected && selected.length">
                                <div class="count-selected">@{{selected.length}} {{__("file selected")}}</div>
                                <div class="clear-selected" @click="selected=[]"><i>{{__("unselect")}}</i></div>
                            </div>
                        </div>
                        <div class="col-right" v-show="selected.length">
                            <button class="btn btn-primary" :class="{disabled:!selected.length}" @click="sendFiles">{{__("Use file")}}</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/x-template" id="file-item-template">
        <div class="file-item" :class="fileClass(file)">
            <div class="inner" :class="{active:selected.indexOf(file.id) !== -1 }" @click="selectFile(file)" :title="file.file_name">
                <div class="file-thumb" v-if="viewType=='grid'" v-html="getFileThumb(file)">

                </div>
                <div class="file-name">@{{file.file_name}}</div>
                <span class="file-checked-status" v-show="selected.indexOf(file.id) !== -1">
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M186.301 339.893L96 249.461l-32 30.507L186.301 402 448 140.506 416 110z"/></svg>
            </span>
            </div>
        </div>
    </script>
    </div>
@endsection
@section ('scripts')

    <link src="{{ asset('MediaGallery/browser.css') }}"></link>
    <script src="{{ asset('MediaGallery/vue.js') }}"></script>
    <script src="{{ asset('MediaGallery/browser.js') }}"></script>

    <script>



        const export2Pdf = async () => {

            let printHideClass = document.querySelectorAll('.print-hide');
            printHideClass.forEach(item => item.style.display = 'none');
            await fetch('http://127.0.0.1:8000/export-pdf/'+{{$eleve->id}}+'/'+{{$trimester}}, {
                method: 'GET'
            }).then(response => {
                if (response.ok) {
                    console.log(response);
                    response.json().then(response => {
                        var link = document.createElement('a');
                        link.href = response;
                        link.click();

                        printHideClass.forEach(item => item.style.display='');
                    });
                }
            }).catch(error => console.log(error));
        }
    </script>

    <script>
        window.url="{{URL::to('/')}}";
        $(document).on('click','.dungdt-upload-box-normal .btn-field-upload,.dungdt-upload-box-normal .attach-demo',function () {
            let p = $(this).closest('.dungdt-upload-box');
            let nameOfFile=''
            uploaderModal.show({
                multiple:false,
                file_type:'pdf',
                onSelect:function (files) {
                    console.log(JSON.stringify(files))
                    p.addClass('active');
                    // p.find('.attach-demo').html('<img src="/images/pdf.png"/><p>'+files[0].thumb_size+'</p>'); get all schema of file
                    //get the name of file with extension
                    p.find('.attach-demo').html('<img src="/images/pdf.png"/><p>'+files[0].file_name+'.'+files[0].file_extension+'</p>');
                    p.find('input').val(files[0].id);

                    var inputidF = document.getElementById("idfile");
                    inputidF.setAttribute('value', files[0].id)

                    pdffile=document.getElementById("pathfile");
                    pdffile.setAttribute('value', files[0].file_path);
                    console.log(pdffile);

                },
            });

        });

        $(document).on('click','.dungdt-upload-box-normal .delete',function (e) {
            e.preventDefault();
            let p = $(this).closest('.dungdt-upload-box');
            p.find("input").attr('value','')
            p.removeClass("active");
        });


    </script>
    <script type="text/javascript">

        function PreviewImage() {
          var  pdffile =document.getElementById("pathfile").value;
            var  viewerIF =document.getElementById("viewer");

          if(pdffile){
              viewerIF.setAttribute('src','{{ url('/').'/'}}'+pdffile)
            }
        }

        $('#pathF').on("change", function(){PreviewImage(); });
        PreviewImage();
    </script>
    <script type="text/javascript">
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
@endsection
