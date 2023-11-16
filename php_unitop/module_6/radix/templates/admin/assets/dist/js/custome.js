function toSlug(title){
    let slug = title.toLowerCase(); //Chuyển thành chữ thường

   

    //lọc dấu
    slug = slug.replace(/á|à|ả|ạ|ã|ă|ắ|ằ|ẳ|ẵ|ặ|â|ấ|ầ|ẩ|ẫ|ậ/gi, 'a');
    slug = slug.replace(/é|è|ẻ|ẽ|ẹ|ê|ế|ề|ể|ễ|ệ/gi, 'e');
    slug = slug.replace(/i|í|ì|ỉ|ĩ|ị/gi, 'i');
    slug = slug.replace(/ó|ò|ỏ|õ|ọ|ô|ố|ồ|ổ|ỗ|ộ|ơ|ớ|ờ|ở|ỡ|ợ/gi, 'o');
    slug = slug.replace(/ú|ù|ủ|ũ|ụ|ư|ứ|ừ|ử|ữ|ự/gi, 'u');
    slug = slug.replace(/ý|ỳ|ỷ|ỹ|ỵ/gi, 'u');
    slug = slug.replace(/đ/gi, 'd');

    //chuyển dấu cách (khoảng trắng) thành gạch ngang
    slug = slug.replace(/ /gi, '-');

    //Xoá tất cả các ký tự đặc biệt
    slug = slug.replace(/\`|\~|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi, '');
    slug = slug.trim(); //Xoá khoảng trắng 2 đầu
    return slug;
}
// lấy id từ url

let fullUrl = window.location.href;
let searchParams = new URLSearchParams(fullUrl); 
let id = searchParams.get('id');
console.log(id);


let sourceTitle = document.querySelector('.slug');
let slugRender = document.querySelector('.render-slug');

let renderLink = document.querySelector('.render-link');
if(renderLink!==null){
    // lấy slug 
    let slut = '';
    if(slugRender!==null){
        slug = '/'+prefixUrl+'/'+slugRender.value.trim()+'-'+id+'.html';
    }
    if(id!==null){
        renderLink.querySelector('span').innerHTML = `<a href="${rootUrl+slug}" target="_blank">${rootUrl+slug}</a>`;
    }else{
        renderLink.querySelector('span').innerHTML = 'Vui lòng cập nhật để hiển thị link';
    }
    
}

if (sourceTitle!==null && slugRender!==null){
    sourceTitle.addEventListener('keyup', (e)=>{
        // if(sessionStorage.getItem('save_slug')){
            
        // }
        let title = e.target.value;

            if (title!==null){
                let slug = toSlug(title);

                slugRender.value = slug;

            }
        
    });


    sourceTitle.addEventListener('change',()=>{
        sessionStorage.setItem('save_slug',1);
        if(id!==null){
            let currentLink = rootUrl+'/'+prefixUrl+'/'+slugRender.value.trim()+'-'+id+'.html';
            renderLink.querySelector('span a').innerHTML=currentLink;
            renderLink.querySelector('span a').href=currentLink;
        }
        //renderLink.querySelector('span a').innerHTML='/'+prefixUrl+'/'+slugRender.value.trim()+'.html';
    });

    slugRender.addEventListener('change', (e)=>{
        let slugValue = e.target.value;
        if(slugValue.trim()==''){
            sessionStorage.removeItem('save_slug');
            let slug = toSlug(sourceTitle.value);
            e.target.value = slug;
        }
        if(id!==null){
            let currentLink = rootUrl+'/'+prefixUrl+'/'+slugRender.value.trim()+'-'+id+'.html';
            renderLink.querySelector('span a').innerHTML=currentLink;
            renderLink.querySelector('span a').href=currentLink;
        }
        
    });

    if(slugRender.value.trim()==''){
        sessionStorage.removeItem('save_slug');
    }
    
}

//xử lý ckeditor với class
let classTextarea = document.querySelectorAll('.editor');
if(classTextarea!==null){
    classTextarea.forEach((item,index)=>{
        item.id = 'editor_'+(index+1);
        CKEDITOR.replace(item.id);
    });
}

//xử lý mớ popup ckfinder
function openCkfinder(){
    let chooseImages = document.querySelectorAll('.choose-image');
if(chooseImages!==null){
    chooseImages.forEach(function(item){
        item.addEventListener('click',function(){
            let parentElementObject = this.parentElement;
            while(parentElementObject){
                parentElementObject = parentElementObject.parentElement;
                if(parentElementObject.classList.contains('ckfinder-group')){
                    break;
                }
            }
            CKFinder.popup( {
                chooseFiles: true,
                width: 800,
                height: 600,
                onInit: function( finder ) {
                    finder.on( 'files:choose', function( evt ) {
                        let fileUrl = evt.data.files.first().getUrl();
                        //Xử lý chèn link ảnh vào input
                        parentElementObject.querySelector('.image-render').value=fileUrl;
                    } );
                    finder.on( 'file:choose:resizedImage', function( evt ) {
                        let fileUrl = evt.data.resizedUrl;
                        //Xử lý chèn link ảnh vào input
                        parentElementObject.querySelector('.image-render').value=fileUrl;
                    } );
                }
            } );
        });
        
    });
}
}

openCkfinder();
// xử lý thêm dữ liệu dới dạng repeater
const galleryItemHtml = `<div class="gallery-item">
<div class="row">
    <div class="col-11">
        <div class="row ckfinder-group">
            <div class="col-10">
                <input type="text" class="form-control image-render" name="gallery[]" value="" placeholder="Đường dẫn ảnh...">
            </div>
            <div class="col-2">
                <button type="button" class="btn btn-success btn-block choose-image">Chọn ảnh</button>
            </div>
        </div>
    </div>
    <div class="col-1">
        <a href="#" class="remove btn btn-danger btn-block"><i class="fa fa-times"></i></a>
    </div>
</div>

</div> <!-- end gallery-item -->`;

const addGalleryObject = document.querySelector('.add-gallery');
const galleryImagesObject = document.querySelector('.gallery-images');

if(addGalleryObject!==null && galleryImagesObject!==null){
    addGalleryObject.addEventListener('click',function (e) {
        e.preventDefault();
        let galleryItemHtmlNode = new DOMParser().parseFromString(galleryItemHtml,'text/html').querySelector('.gallery-item');
        galleryImagesObject.appendChild(galleryItemHtmlNode);
        openCkfinder();
        
    });

    galleryImagesObject.addEventListener('click',function(e){
        e.preventDefault(); //ngăn tình trang mặc định html (thẻ a)
        if(e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')){
            if(confirm('Bạn có chắc muốn xóa ?')){
                let galleryItem = e.target;
                while(galleryItem){
                    galleryItem = galleryItem.parentElement;
                    if(galleryItem.classList.contains('gallery-item')){
                        break;
                    }
                }
                if(galleryItem!==null){
                    galleryItem.remove();
                }
            }
        }
    });
    
}
const slideItemHtml =  `<div class="slide-item">
<div class="row">
    <div class="col-11">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Tiêu đề</label>
                    <input type="text" class="form-control" name="home_slide[slide_title][]" value="" placeholder="Tiêu đề...">
                    
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Nút xem thêm</label>
                    <input type="text" class="form-control" name="home_slide[slide_button_text][]" value="" placeholder="Link của nút thêm...">
                     
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Link nút xem thêm</label>
                    <input type="text" class="form-control" name="home_slide[slide_button_link][]" value="" placeholder="Link của nút thêm...">
                    
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Link video</label>
                    <input type="text" class="form-control" name="home_slide[slide_video][]" value="" placeholder="Link video youtube...">
                    
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Ảnh 1</label>
                    <div class="row ckfinder-group">
                        <div class="col-10">
                            <input type="text" class="form-control image-render" name="home_slide[slide_image_1][]" value="" placeholder="Đường dẫn ảnh 1..."> 
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-image"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Ảnh 2</label>
                    <div class="row ckfinder-group">
                        <div class="col-10">
                            <input type="text" class="form-control image-render" name="home_slide[slide_image_2][]" value="" placeholder="Đường dẫn ảnh 2..."> 
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-image"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Ảnh nền</label>
                    <div class="row ckfinder-group">
                        <div class="col-10">
                            <input type="text" class="form-control image-render" name="home_slide[slide_bg][]" value="" placeholder="Đường dẫn ảnh nền..."> 
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-image"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Mô tả</label>
                    <textarea name="home_slide[slide_desc][]" class="form-control" placeholder="Mô tả slide..."></textarea>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Vị trí</label>
                    <select class="form-control" name="home_slide[slide_position][]" id="">
                        <option value="left">Trái</option>
                        <option value="right">Phải</option>
                        <option value="center">Giữa</option>
                    </select>
                </div>
            </div>
        </div>
    </div>
    <div class="col-1">
        <a href="#" class="btn btn-danger btn-sm btn-block remove">&times;</a>
    </div>
</div>
</div><!--  end slide-item -->`;


const addSlideObject = document.querySelector('.add-slide');
const slideWrapperOpject = document.querySelector('.slide-wrapper');
if(addSlideObject!==null && slideWrapperOpject!==null){
    addSlideObject.addEventListener('click',function(){
        let slideItemHtmlNode = new DOMParser().parseFromString(slideItemHtml,'text/html').querySelector('.slide-item');
        slideWrapperOpject.appendChild(slideItemHtmlNode);
        openCkfinder();
        
    });

    slideWrapperOpject.addEventListener('click',function(e){
        e.preventDefault(); //ngăn tình trang mặc định html (thẻ a)
        if(e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')){
            if(confirm('Bạn có chắc muốn xóa ?')){
                let slideItem = e.target;
                while(slideItem){
                    slideItem = slideItem.parentElement;
                    if(slideItem.classList.contains('slide-item')){
                        break;
                    }
                }
                if(slideItem!==null){
                    slideItem.remove();
                }
            }
        }
    });

}

const skillItemHtml =  `<div class="skill-item">
<div class="row">
    <div class="col-11">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Tên năng lực</label>
                    <input type="text" class="form-control" name="home_about[skill][name][]" placeholder="Tên năng lực...">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Giá trị</label>
                    <input type="text" class="ranger form-control" name="home_about[skill][value][]">
                </div>
            </div>
        </div>
    </div>
    <div class="col-1">
         <a href="#" class="btn btn-danger btn-sm btn-block remove">&times;</a> 
    </div>
</div>
</div><!--  end. skill-item -->`;
const addSkillObject = document.querySelector('.add-skill');
const skillWrapperOpject = document.querySelector('.skill-wrapper');
if(addSkillObject!==null && skillWrapperOpject!==null){
    addSkillObject.addEventListener('click',function(e){
        e.preventDefault();
        let skillItemHtmlNode = new DOMParser().parseFromString(skillItemHtml,'text/html').querySelector('.skill-item');
        skillWrapperOpject.appendChild(skillItemHtmlNode);
        openCkfinder();
        $('.ranger').ionRangeSlider({
            min     : 0,
            max     : 100,
            type    : 'single',
            step    : 1,
            postfix : ' %',
            prettify: false,
            hasGrid : true
          })
    });

    skillWrapperOpject.addEventListener('click',function(e){
        e.preventDefault(); //ngăn tình trang mặc định html (thẻ a)
        if(e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')){
            if(confirm('Bạn có chắc muốn xóa ?')){
                let skillItem = e.target;
                while(skillItem){
                    skillItem = skillItem.parentElement;
                    if(skillItem.classList.contains('skill-item')){
                        break;
                    }
                }
                if(skillItem!==null){
                    skillItem.remove();
                }
            }
        }
    });

    $('.ranger').ionRangeSlider({
        min     : 0,
        max     : 100,
        type    : 'single',
        step    : 1,
        postfix : ' %',
        prettify: false,
        hasGrid : true
      });

}
const factItemHtml = `                <div class="fact-item">
<div class="row">
    <div class="col-11">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                <label for="">Icon thành tích</label>
                    <input type="text" class="form-control" name="home_fact[right][icon][]" value="" placeholder="Icon thành tích...">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Số thành tích</label>
                    <input type="text" class="form-control" name="home_fact[right][number][]" value="" placeholder="Số lượng thành tích...">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Đơn vị Số lượng</label>
                    <input type="text" class="form-control" name="home_fact[right][unit][]" value="" placeholder="Đơn vị đo số lượng thành tích...">
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Giải thưởng</label>
                    <input type="text" class="form-control" name="home_fact[right][award][]" value="" placeholder="Giải thưởng...">
                </div>
            </div>
        </div>
    </div>
    <div class="col-1">
        <a href="#" class="btn btn-danger btn-sm btn-block remove">&times;</a> 
    </div>
</div>
</div><!--  end. skill-item -->
`;
const addFactObject = document.querySelector('.add-fact');
const factWrapperOpject = document.querySelector('.fact-wrapper');
if(addFactObject!==null && factWrapperOpject!==null){
    addFactObject.addEventListener('click',function(e){
        e.preventDefault();
        let factItemHtmlNode = new DOMParser().parseFromString(factItemHtml,'text/html').querySelector('.fact-item');
        factWrapperOpject.appendChild(factItemHtmlNode);
        openCkfinder();
        
    });

    factWrapperOpject.addEventListener('click',function(e){
        e.preventDefault(); //ngăn tình trang mặc định html (thẻ a)
        if(e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')){
            if(confirm('Bạn có chắc muốn xóa ?')){
                let skillItem = e.target;
                while(skillItem){
                    skillItem = skillItem.parentElement;
                    if(skillItem.classList.contains('fact-item')){
                        break;
                    }
                }
                if(skillItem!==null){
                    skillItem.remove();
                }
            }
        }
    });

}

const partnerItemHtml = `<div class="partner-item">
<div class="row">
    <div class="col-11">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Ảnh đối tác</label>
                    <div class="row ckfinder-group">
                        <div class="col-10">
                            <input type="text" class="form-control image-render" name="home_partner_content[logo][]" placeholder="Đường dẫn ảnh..."> 
                        </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-image"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Link đối tác</label>
                    <input type="text" class="form-control" name="home_partner_content[link][]">
                </div>
            </div>
        </div>
    </div>
    <div class="col-1">
        <a href="#" class="btn btn-danger btn-sm btn-block remove">&times;</a> 
    </div>
</div>
</div><!--  end. skill-item -->`;
const addPartnerObject = document.querySelector('.add-partner');
const partnerWrapperOpject = document.querySelector('.partner-wrapper');
if(addPartnerObject!==null && partnerWrapperOpject!==null){
    addPartnerObject.addEventListener('click',function(e){
        e.preventDefault();
        let partnerItemHtmlNode = new DOMParser().parseFromString(partnerItemHtml,'text/html').querySelector('.partner-item');
        partnerWrapperOpject.appendChild(partnerItemHtmlNode);
        openCkfinder();
        
    });

    partnerWrapperOpject.addEventListener('click',function(e){
        e.preventDefault(); //ngăn tình trang mặc định html (thẻ a)
        if(e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')){
            if(confirm('Bạn có chắc muốn xóa ?')){
                let skillItem = e.target;
                while(skillItem){
                    skillItem = skillItem.parentElement;
                    if(skillItem.classList.contains('partner-item')){
                        break;
                    }
                }
                if(skillItem!==null){
                    skillItem.remove();
                }
            }
        }
    });

}


const teamItemHtml = `<div class="team-item">
<div class="row">
    <div class="col-11">
        <div class="row">
            <div class="col-6">
                <div class="form-group">
                    <label for="">Tên thành viên</label>
                    <input type="text" class="form-control" name="team_content[name][]" >
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Chức vụ</label>
                    <input type="text" class="form-control" name="team_content[position][]" >
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Ảnh</label>
                    <div class="row ckfinder-group">
                        <div class="col-10">
                            <input type="text" class="form-control image-render" name="team_content[image][]" placeholder="Đường dẫn ảnh..."> </div>
                        <div class="col-2">
                            <button type="button" class="btn btn-success btn-block choose-image"><i class="fas fa-image"></i></button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Facebook</label>
                    <input type="text" class="form-control" name="team_content[facebook][]" >
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Twitter</label>
                    <input type="text" class="form-control" name="team_content[twitter][]" >
                </div>
            </div>
            <div class="col-6">
                <div class="form-group">
                    <label for="">Behance</label>
                    <input type="text" class="form-control" name="team_content[behance][]" >
                </div>
            </div>
            <div class="col-12">
                <div class="form-group">
                    <label for="">Linkedin</label>
                    <input type="text" class="form-control" name="team_content[linkedin][]" >
                </div>
            </div>
        </div>
    </div>
    <div class="col-1">
        <a href="#" class="btn btn-danger btn-sm btn-block remove">&times;</a> 
    </div>
</div>
</div><!--  end. team-item -->`;
const addTeamObject = document.querySelector('.add-team');
const teamWrapperOpject = document.querySelector('.team-wrapper');
if(addTeamObject!==null && teamWrapperOpject!==null){
    addTeamObject.addEventListener('click',function(e){
        e.preventDefault();
        let teamItemHtmlNode = new DOMParser().parseFromString(teamItemHtml,'text/html').querySelector('.team-item');
        teamWrapperOpject.appendChild(teamItemHtmlNode);
        openCkfinder();
        
    });

    teamWrapperOpject.addEventListener('click',function(e){
        e.preventDefault(); //ngăn tình trang mặc định html (thẻ a)
        if(e.target.classList.contains('remove') || e.target.parentElement.classList.contains('remove')){
            if(confirm('Bạn có chắc muốn xóa ?')){
                let skillItem = e.target;
                while(skillItem){
                    skillItem = skillItem.parentElement;
                    if(skillItem.classList.contains('team-item')){
                        break;
                    }
                }
                if(skillItem!==null){
                    skillItem.remove();
                }
            }
        }
    });

}

// menu-editor-custom
// icon picker options
var iconPickerOptions = {searchText: "Buscar...", labelHeader: "{0}/{1}"};
// sortable list options
var sortableListOptions = {
    placeholderCss: {'background-color': "#cccccc"}
};
var editor = new MenuEditor('myEditor', 
            { 
            listOptions: sortableListOptions, 
            iconPicker: iconPickerOptions,
            maxLevel: 2 // (Optional) Default is -1 (no level limit)
            // Valid levels are from [0, 1, 2, 3,...N]
            });
editor.setForm($('#frmEdit'));
editor.setUpdateButton($('#btnUpdate'));
//Calling the update method
$("#btnUpdate").click(function(){
    editor.update();
});
// Calling the add method
$('#btnAdd').click(function(){
    editor.add();
});

// var arrayJson = [{"href":"http://home.com","icon":"fas fa-home","text":"Home", "target": "_top", "title": "My Home"},{"icon":"fas fa-chart-bar","text":"Opcion2"},{"icon":"fas fa-bell","text":"Opcion3"},{"icon":"fas fa-crop","text":"Opcion4"},{"icon":"fas fa-flask","text":"Opcion5"},{"icon":"fas fa-map-marker","text":"Opcion6"},{"icon":"fas fa-search","text":"Opcion7","children":[{"icon":"fas fa-plug","text":"Opcion7-1","children":[{"icon":"fas fa-filter","text":"Opcion7-1-1"}]}]}];

if(typeof arrayJson!=='undefined'){
    editor.setData(arrayJson);
}

if($('.save-menu').length>0){
    $('.save-menu').on('click',function(e){
        e.preventDefault(); //vô hiệu hóa submit form
        var str = editor.getString();
        $("#menu-content").val(str);
        $('#frmEdit').submit();
    });
}

// xử lý check phân quyền
// let pemissionObj = document.querySelector('.permission-lists');

// if(pemissionObj!==null){
//     const allowRoles = [
//         'add',
//         'edit',
//         'delete',
//         'duplicate'
//     ];
//     let rowPermissionObj = pemissionObj.querySelectorAll('tr');
//     if(rowPermissionObj!==null){
//         rowPermissionObj.forEach(function (item){
//             let checkboxObj = item.querySelectorAll('input[type="checkbox"]');
//             if(checkboxObj!==null){
//                 checkboxObj.forEach(function (checkbox){
//                     checkbox.addEventListener('click', function(){
//                         let checkboxValue = this.value;
//                         if(checkboxValue.trim()!=='' && checkboxValue.includes(checkboxValue)){
//                             let viewRole = item.querySelectorAll('input[value="lists"]');
//                             viewRole[0].checked=true;
//                             // console.log(viewRole);
//                         }

                        
//                     });
//                 });
//             }
            
//         });
//     }
    
// }




