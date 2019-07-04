//function validateAntiqueForm() {
    //let status = true;

    //document.querySelector('#error-message').classList.add('d-none');
    //document.querySelector('#error-message').innerHTML='';

    //const title = document.querySelector('#title').value;
    //if(!title.match('/.*[^\s]{3,}.*/')) {
        //document.querySelector('#error-message').innerHTML+="Naslov mora sadržati minimum tri vidljiva karaktera.<br>";
        //document.querySelector('#error-message').classList.remove('d-none');
        //status = false;
    //}

   
    //const brief_description = document.querySelector('#brief_description').value;
    //if(!brief_description.match('/.*[^\s]{2,}.*/')) {
        //document.querySelector('#error-message').innerHTML+="Kratak opis mora sadržati minimum dva vidljiva karaktera.<br>";
        //document.querySelector('#error-message').classList.remove('d-none');
        //status = false;
    //}

    //return status;
//}

function validateAntiqueEditForm() {
    console.log(document.getElementById('#title2').value);
    let status = true;

    document.querySelector('#error-message2').classList.add('d-none');
    document.querySelector('#error-message2').innerHTML='';

    var title = document.querySelector('#title2').value;
    if(!title.match('/.*[^\s]{3,}.*/')) {
        document.querySelector('#error-message2').innerHTML+="2 Naslov mora sadržati minimum tri vidljiva karaktera.<br>";
        document.querySelector('#error-message2').classList.remove('d-none');
        status = false;
    }

   
    var brief_description = document.querySelector('#brief_description2').value;
    if(!brief_description.match('/.*[^\s]{2,}.*/')) {
        document.querySelector('#error-message2').innerHTML+="Kratak opis mora sadržati minimum dva vidljiva karaktera.<br>";
        document.querySelector('#error-message2').classList.remove('d-none');
        status = false;
    }

    return status;
}

function validateAntiqueAddForm() {
    let status = true;

    document.querySelector('#error-message1').classList.add('d-none');
    document.querySelector('#error-message1').innerHTML='';

    var title = document.querySelector('#title1').value;
    if(!title.match('/.*[^\s]{3,}.*/')) {
        document.querySelector('#error-message1').innerHTML+="1 Naslov mora sadržati minimum tri vidljiva karaktera.<br>";
        document.querySelector('#error-message1').classList.remove('d-none');
        status = false;
    }

   
    var brief_description = document.querySelector('#brief_description1').value;
    if(!brief_description.match('/.*[^\s]{2,}.*/')) {
        document.querySelector('#error-message1').innerHTML+="Kratak opis mora sadržati minimum dva vidljiva karaktera.<br>";
        document.querySelector('#error-message1').classList.remove('d-none');
        status = false;
    }

    return status;
}


//function validateCategoryForm() {
    //let status = true;

    //document.querySelector('#error-message').classList.add('d-none');
    //document.querySelector('#error-message').innerHTML='';

    //const title = document.querySelector('#name').value;
    //if(!title.match('/.*[^\s]{3,}.*/')) {
        //document.querySelector('#error-message').innerHTML+="Naziv kategorije mora sadržati minimum tri vidljiva karaktera.<br>";
        //document.querySelector('#error-message').classList.remove('d-none');
        //status = false;
    //}

    //return status;
//}

function validateCategoryEditForm() {
    let status = true;

    document.querySelector('#error-message4').classList.add('d-none');
    document.querySelector('#error-message4').innerHTML='';

    var title = document.querySelector('#name4').value;
    if(!title.match('/.*[^\s]{3,}.*/')) {
        document.querySelector('#error-message4').innerHTML+="Naziv kategorije mora sadržati minimum tri vidljiva karaktera.<br>";
        document.querySelector('#error-message4').classList.remove('d-none');
        status = false;
    }

    return status;
}

function validateCategoryAddForm() {
    let status = true;

    document.querySelector('#error-message3').classList.add('d-none');
    document.querySelector('#error-message3').innerHTML='';

    var title = document.querySelector('#name3').value;
    if(!title.match('/.*[^\s]{3,}.*/')) {
        document.querySelector('#error-message3').innerHTML+="Naziv kategorije mora sadržati minimum tri vidljiva karaktera.<br>";
        document.querySelector('#error-message3').classList.remove('d-none');
        status = false;
    }

    return status;
}