$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});

// Get Data
var clubData
$(document).ready(function() {
    $.getJSON('/clubs/data', function(data) {
        clubData = data;
    });
});

// Club Match Input
var clubMatch = [
    [
        {
            id: 'club1',
            score: 'score1'
        },
        {
            id: 'club2',
            score: 'score2'
        }
    ]
];

var clubMatchCount = 2;

document.getElementById('add-match-form').onclick = function () {addForm()};

function addForm() {
    clubMatch.push([
        {
            id: 'club'+(clubMatchCount+1),
            score: 'score'+(clubMatchCount+1)
        },
        {
            id: 'club'+(clubMatchCount+2),
            score: 'score'+(clubMatchCount+2)
        }
    ]);

    let newRow = document.createElement('div');
    newRow.classList.add('row');

    let newCol1 = document.createElement('div');
    newCol1.classList.add('col');
    newCol1.classList.add('d-flex');

    let newCol2 = document.createElement('div');
    newCol2.classList.add('col');
    newCol2.classList.add('d-flex');
    newCol2.classList.add('flex-row-reverse');

    let formContainer1 = document.createElement('div');
    formContainer1.classList.add('mb-3');

    let formContainer2 = document.createElement('div');
    formContainer2.classList.add('mb-3');

    let formContainer3 = document.createElement('div');
    formContainer3.classList.add('mb-3');

    let formContainer4 = document.createElement('div');
    formContainer4.classList.add('mb-3');

    let select1 = document.createElement('select');
    select1.classList.add('form-select');
    select1.classList.add('rounded-0');
    select1.setAttribute('id','club'+(clubMatchCount+1))

    let select2 = document.createElement('select');
    select2.classList.add('form-select');
    select2.classList.add('rounded-0');
    select2.setAttribute('id','club'+(clubMatchCount+2))

    let option1 = document.createElement('option');
    option1.setAttribute('selected',true);
    option1.innerHTML = 'Select Club';
    option1.value = "";
    select1.appendChild(option1);

    let option2 = document.createElement('option');
    option2.setAttribute('selected',true);
    option2.innerHTML = 'Select Club';
    option2.value = "";
    select2.appendChild(option2);

    clubData.forEach(club => {
        let option1 = document.createElement('option');
        option1.value = club.id;
        option1.innerHTML = club.name+'-'+club.city;
        select1.appendChild(option1);

        let option2 = document.createElement('option');
        option2.value = club.id;
        option2.innerHTML = club.name+'-'+club.city;
        select2.appendChild(option2);
    });

    let score1 = document.createElement('input');
    score1.classList.add('form-control');
    score1.classList.add('rounded-0');
    score1.setAttribute('placeholder', 'score');
    score1.setAttribute('id','score'+(clubMatchCount+1))
    score1.value = 0;

    let score2 = document.createElement('input');
    score2.classList.add('form-control');
    score2.classList.add('rounded-0');
    score2.setAttribute('placeholder', 'score');
    score2.setAttribute('id','score'+(clubMatchCount+2))
    score2.value = 0;

    formContainer1.appendChild(select1);
    formContainer2.appendChild(score1);
    formContainer3.appendChild(select2);
    formContainer4.appendChild(score2);
    newCol1.appendChild(formContainer1);
    newCol1.appendChild(formContainer2);
    newCol2.appendChild(formContainer3);
    newCol2.appendChild(formContainer4);
    newRow.appendChild(newCol1);
    newRow.appendChild(newCol2);

    document.getElementById('match-form').appendChild(newRow);

    console.log(clubMatch);

    clubMatchCount += 2;
}

// Club Match Post
$("#match-form-post").submit(function(event) {
    event.preventDefault();

    var $form = $( this ), url = $form.attr( "action" );

    let clubMatchPost = [];
    let anyError = [];

    clubMatch.forEach(clubs => {
        let clubMatchEach = [];

        clubs.forEach(club => {
            let e = document.getElementById(club.id);
            let id = e.value;
            let name = e.options[e.selectedIndex].text
            let score = document.getElementById(club.score).value;
            if (clubMatchEach.some(e => e.club === id)) {
                anyError.push("Can't matching the same club");
            } else {
                if (id !== "") {
                    clubMatchEach.push({club: id, name: name, score: score});
                }
            }
        })

        if (clubMatchEach.length === 2) {
            clubMatchPost.push(clubMatchEach);
        }
    });

    if (anyError.length > 0) {
        anyError.forEach(err => {
            Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: err,
                showConfirmButton: true,
                confirmButtonText: 'Ok',
                confirmButtonColor: '#f27474'
            })
        })
    } else {
        var clubMatchPosting = $.post( url, { data: clubMatchPost } );

        clubMatchPosting.done(function( result ) {
            console.log(result);
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: result,
                showConfirmButton: true,
                confirmButtonText: 'Ok',
                confirmButtonColor: '#a5dc86'
            }).then(() => {
                window.location.reload();
            })
        });

        clubMatchPosting.fail(function( result ) {
            Swal.fire({
                icon: 'error',
                title: 'Failed',
                text: result.responseText,
                showConfirmButton: true,
                confirmButtonText: 'Ok',
                confirmButtonColor: '#f27474'
            })
        });
    }
});
