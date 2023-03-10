
// const majorMenuBtns = document.querySelectorAll('.major__menu-btn')
// majorMenuBtns.forEach((majorMenuBtn) => {
//     majorMenuBtn.addEventListener('click', () => {
//         const menuBtnId = majorMenuBtn.getAttribute('id')
//         let url = '/' + menuBtnId
//         console.log(url)
//         const promise = fetch(url, {
//             method: 'POST',
//             body: '',
//         })
//         return promise.then((response) => {
//             response.json()
//                 .then((resp) => {
//                     console.log(resp)
//                     return resp
//                 })
//
//         })
//     })
// })
// $('#single-blog__comments-form').on('submit', function (event) {
//     event.preventDefault();
//     let name = $('#floatingInputGroup1').val();
//     let comments = $('#floatingTextarea2').val();
//     let blogId = $('#blog-id').val();
//
//     $.ajax({
//         url: "/comments",
//         type: "POST",
//         data: {
//             "_token": "{{ csrf_token() }}",
//             name: name,
//             comments: comments,
//             blogId: blogId,
//         },
//         success: function (response) {
//             clearErrors()
//             $('.single-blog__list-comments').prepend(response.html)
//         },
//         error :function( data ) {
//             if (data.status === 422) {
//                 var errors = $.parseJSON(data.responseText);
//                 $.each(errors, function (key, value) {
//                     if ($.isPlainObject(value)) {
//                         $.each(value, function (key, value) {
//                             if (key === 'name' && value.length > 0) {
//                                 $('.validation-name').empty();
//                                 $('.validation-name').addClass("alert alert-danger");
//                                 $('.validation-name').show().append(value + "<br/>");
//                             }
//
//                             if (key === 'comments' && value.length > 0) {
//                                 $('.validation-comment').empty();
//                                 $('.validation-comment').addClass("alert alert-danger");
//                                 $('.validation-comment').show().append(value + "<br/>");
//                             }
//                         });
//                     } else {
//                         clearErrors()
//                     }
//                 });
//             }
//         }
//     });
// });
