

(function ($) {


    window.url="";
    window.uploaderModal = new Vue({
        el: '#cdn-browser',
        data:{
            files:[],
            viewType:'grid',
            total:0,
            totalPage:0,
            fileTypes:[],
            selected:[],
            selectedLists:[],
            showUploader:false,
            apiFinished:false,
            modalEl:false,
            multiple:false,
            isLoading:false,
            filter:{
                page:1
            },
            onSelect:function () {

            },
            uploadConfigs:{

            },

        },

        mounted(){
            let me = this;

            this.modalEl = $('#cdn-browser-modal').modal({
                show:false
            }).on('show.bs.modal',function () {
                me.reloadLists();
            });

            this.$nextTick(function () {
                $(this.$refs.files).change(function () {
                    me.upload(this.files)
                })
            })

        },
        watch:{
            uploadConfigs(val){
                this.multiple = val.multiple;
                this.onSelect = val.onSelect;
            }
        },
        methods:{
            show(configs){
                this.files = [];
                this.resetSelected();
                this.uploadConfigs = configs;
                this.modalEl.modal('show');
            },
            hide(){
                this.modalEl.modal('hide');
            },
            changePage(p,e){
                e.preventDefault();
                this.filter.page = p;
                this.reloadLists();
            },
            selectFile(file){
                var index = this.selected.indexOf(file.id);
                if (index > -1) {
                    this.selected.splice(index, 1);
                    this.selectedLists.splice(index,1);
                }else{
                    if(!this.multiple){
                        this.selected = [];
                        this.selectedLists = [];
                    }
                    this.selected.push(file.id);
                    this.selectedLists.push(file);
                }
            },
            removeFiles() {
                var me = this;

               bookingCoreApp.showConfirm({
                  message: i18n.confirm_delete,

                    callback: function(result){
                        if(result){
                            me.isLoading = true;
                            $.ajax({
                                url:window.url+'/media/removeFiles',
                                type:'POST',
                                data:{
                                    file_ids : me.selected
                                },
                                dataType:'json',
                                success:function (data) {
                                    if(data.status === 1){

                                        bookingCoreApp.showSuccess(data);
                                    }
                                    if(data.status === 0){
                                        me.showError(data);
                                    }
                                    me.isLoading = false;
                                    me.reloadLists();
                                },
                                error:function (e) {
                                    me.isLoading = false;
                                    bookingCoreApp.showAjaxError(e);
                                    me.resetSelected();
                                }
                            });
                        }
                    }
                })
            },
            sendFiles(){
                if(typeof this.onSelect == 'function'){
                    let f = this.onSelect;
                    f(this.selectedLists)
                }
                this.hide();
            },
            init(){
                var me = this;
                this.reloadLists();
            },
            reloadLists(){
                var me = this;
                //to get name of my current page
                var str= window.location.href;
                var value = str.split(/[\/\\]/);
                console.log(value[4]);
                $("#cdn-browser .icon-loading").addClass("active");
                me.isLoading = true;
                $.ajax({
                    url: window.url+'/admin/media/getLists/'+value[4],
                    type:'POST',
                    data:{
                        file_type:this.uploadConfigs.file_type,
                        page:this.filter.page,
                        s:this.filter.s
                    },
                    dataType:'json',
                    success:function (json) {
                        me.resetSelected();
                        me.files = json.data;
                        me.total = json.total;
                        me.totalPage = json.totalPage;
                        me.isLoading = false;
                        me.apiFinished = true;
                    }

                });
            },
            showError:function (configs) {
                var args = {};
                if(typeof configs == 'object')
                {
                    args = configs;
                }else{
                    args.message = configs;
                }
                if(!args.title){
                    args.title = "i18n.warning";
                }
                args.centerVertical = true;
                alert(JSON.stringify(args['message']));
            },
            upload(files){
                var me = this;
                if(!files.length) return ;
                //to get name of my current page
                var str= window.location.href;
                var value = str.split(/[\/\\]/);
console.log('1',window.url+'/admin/media/store/'+value[4]+'/'+value[6]+'/'+value[7]);
                console.log('2',value[6]);console.log('3',value[7]);
                for(var i = 0; i < files.length ; i++){
                    var d = new FormData();
                    var oneMb = 80*1048576; console.log(files.size > oneMb);
                    d.append('file',files[i]);
                    d.append('type',this.uploadConfigs.file_type);
                    me.isLoading = true;
                    $.ajax({
                        url:window.url+'/admin/media/store/'+value[4]+'/'+value[6]+'/'+value[7],
                        data:d,
                        dataType:'json',
                        type:'post',
                        contentType: false,
                        processData: false,
                        success:function (res) {

                            me.isLoading = false;
                            console.log(res);
                            if(res.status)
                            {
                                console.log(res.status);
                                me.reloadLists();
                            }

                            if((res.status === 0)&&(res.message==='The \"\" file does not exist or is not readable.')){
                                alert("Very large file please try to change");

                            }else if((res.status === 0)&&(files.size > oneMb)){
                                alert("Very large file ");
                            }
                            else if(res.status === 0){
                                me.showError(res);
                            }

                            $(me.$refs.files).val('');
                        },
                        error:function(e){
                            bookingCoreApp.showAjaxError(e);
                            $(me.$refs.files).val('');
                            me.isLoading = false;
                        }
                    })
                }
            },
            initUploader(){

            },
            resetSelected(){
                this.selectedLists = [];
                this.selected = [];
                this.total = 0;
                this.totalPage = 0;
                this.apiFinished = false;
            }
        }
    });

    Vue.component('file-item', {
        template:'#file-item-template',
        data: function () {
            return {
                count: 0
            }
        },
        props:['file',"selected","viewType"],
        methods:{
            selectFile(file){
                this.$emit('select-file',file);
            },
            fileClass(file){
                var s = [];
                s.push(file.file_type);

                if(file.file_type.substr(0,5)=='image'){
                    s.push('is-image');
                }else{
                    s.push('not-image');
                }
                return s;
            },
            getFileThumb(file){
                if(file.file_type.substr(0,5)=='image'){
                    return '<img src="'+file.thumb_size+'" onerror="this.src=\'/images/404PictureNotFund.jpg\'">';
                }
                if(file.file_type.substr(0,5)=='video'){
                    return '<img src="/assets/browser/icon/007-video-file.png">';
                }
                if(file.file_type.indexOf('x-zip-compressed')!== -1 || file.file_type.indexOf('/zip')!== -1){
                    return '<img src="/assets/browser/icon/005-zip-2.png">';
                }
                if(file.file_type.indexOf('/pdf')!== -1 ){
                    return '<img src="/images/pdf.png">';
                }

                if(file.file_type.indexOf('/msword')!== -1 || file.file_type.indexOf('wordprocessingml')!== -1){
                    return '<img src="/assets/browser/icon/010-word.png">';
                }
                if(file.file_type.indexOf('spreadsheetml')!== -1  || file.file_type.indexOf('excel')!== -1){
                    return '<img src="/assets/browser/icon/011-excel-file.png">';
                }
                if(file.file_type.indexOf('presentation')!== -1 ){
                    return '<img src="/assets/browser/icon/powerpoint.png">';
                }
                if(file.file_type.indexOf('audio/')!== -1 ){
                    return '<img src="/assets/browser/icon/006-audio-file.png">';
                }


                return '<img src="/assets/browser/icon/008-file.png">';

            },
        }
    })
})(jQuery);

