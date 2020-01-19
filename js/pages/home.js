$(function() {
    $('.modal').modal();
    $('.delete-contact').click(function(){
        let id=$(this).data('id');
        $('#delete_contact_id').val(id);
    });


});


function getURLVars(){
    let vars =[];
    let hash;

    let hashes= window.location.href.slice(window.location.href.indexOf('?')+1).split('&');
    for(var i=0;i<hashes.length;i++){
        hash=hashes[i].split("=");
        //vars.push(hash[0]);
        vars[hash[0]]=hash[1];
    }
    return vars;
}
var q = getURLVars()['q'];
var op = getURLVars()['op'];
if(q=='success' && op=='insert'){
    let toastHTML = "<span>Contact created successfully !</span>";
    let classList = "green darken-1";
    M.toast({
        html:toastHTML,
        classes:classList
    });
}
else if (q=='success' && op=='edit'){
    let toastHTML = "<span>Contact edited successfully  !</span>";
    let classList = "green darken-1";
    M.toast({
        html:toastHTML,
        classes:classList
    });
}
else if (q=='success' && op=='delete'){
    let toastHTML = "<span>Contact deleted successfully  !</span>";
    let classList = "green darken-1";
    M.toast({
        html:toastHTML,
        classes:classList
    });
}
else if (q=='error' && op=='delete'){
    let toastHTML = "<span>Some issue while deleting contact !</span>";
    let classList = "red darken-1";
    M.toast({
        html:toastHTML,
        classes:classList
    });
}
