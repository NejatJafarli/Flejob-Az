//create function
function MyFunc1 () {
    //create variable
    let div = document.getElementById('CompanyExp')
    let companyname = document.getElementsByName('companyname[]')
    let companyrank = document.getElementsByName('companyrank[]')
    let companydate = document.getElementsByName('companydate[]')

    let names = []
    let ranks = []
    let dates = []
    if (companyname.length && companyrank.length && companydate.length) {
        for (let i = 0; i < companyname.length; i++) {
            names.push(companyname[i].value)
            ranks.push(companyrank[i].value)
            dates.push(companydate[i].value)
        }
    }

    // check  companyname ,  companyrank , companydate named fields are empty or not

    let isTrue = true
    for (let i = 0; i < companyname.length; i++)
        if (
            companyname[i].value == '' ||
            companyrank[i].value == '' ||
            companydate[i].value == ''
        ) {
            isTrue = false
            break
        }

    if (!isTrue) {
        alert('Please fill all the fields')
        return
    }
    let str = ` <div class="my-2" style="border: 1px solid black; padding:10px">
    <div class="form-group ">
        <label>Company Name</label>
        <input name="companyname[]" type="text" class="form-control"
            placeholder="Enter Company Name" required>
    </div>
    <div class="form-group">
        <label>Company Rank</label>
        <input name="companyrank[]" type="text" class="form-control"
            placeholder="Enter Company Rank" required>
    </div>
    <div class="form-group">
        <label>Company End Date</label>
        <input name="companydate[]" type="date" class="form-control"
            placeholder="Enter Company End Date" required>
    </div>
`
    //append variable to div
    div.innerHTML += str

    if (names.length && ranks.length && dates.length) {
        for (let i = 0; i < names.length; i++) {
            companyname[i].value = names[i]
            companyrank[i].value = ranks[i]
            companydate[i].value = dates[i]
        }
    }
}

//create function
function MyFunc2 (educationLevelNameArr, educationLevelIdArr) {
    //create variable
    let div = document.getElementById('Education')
    // get educationName ,  educationYear , educationLevel named form elements
    let educationName = document.getElementsByName('educationName[]')
    let educationYear = document.getElementsByName('educationYear[]')
    let educationLevel = document.getElementsByName('educationLevel[]')

    let names = []
    let years = []
    let levels = []
    if (educationName.length && educationYear.length && educationLevel.length) {
        for (let i = 0; i < educationName.length; i++) {
            names.push(educationName[i].value)
            years.push(educationYear[i].value)
            levels.push(educationLevel[i].value)
        }
    }

    // check  educationName ,  educationYear , educationLevel named fields are empty or not

    let isTrue = true
    for (let i = 0; i < educationName.length; i++)
        if (
            educationName[i].value == '' ||
            educationYear[i].value == '' ||
            educationLevel[i].value == ''
        ) {
            isTrue = false
            break
        }

    if (!isTrue) {
        alert('Please fill all fields')
        return
    }

    let str = `
    <div class="my-2" style="border: 1px solid black; padding:10px">

        <div class="form-group ">
            <label>Education Name</label>
            <input name="educationName[]" type="text" class="form-control"
                placeholder="Enter Education Name" required>
        </div>
        <div class="form-group">

            <label>Education Year</label>
            <input name="educationYear[]" type="number" maxlength="4" class="form-control"
                placeholder="Enter Education Year" required>
        </div>
        <div class="form-group">
            <label>Education Level</label>
            <select name="educationLevel[]" class="form-control">
            `
    for (let i = 0; i < educationLevelNameArr.length; i++) {
        str += `<option value="${educationLevelIdArr[i]}">${educationLevelNameArr[i]}</option>`
    }
    str += `
            </select>
        </div>
    </div>
    `

    //append variable to div
    div.innerHTML += str
    if (names.length && years.length && levels.length) {
        for (let i = 0; i < names.length; i++) {
            educationName[i].value = names[i]
            educationYear[i].value = years[i]
            educationLevel[i].value = levels[i]
        }
    }
}

//create function
function MyFunc3 () {
    //create variable
    let div = document.getElementById('Links')
    let linkName = document.getElementsByName('LinkName[]')
    let linkUrl = document.getElementsByName('Link[]')

    let names = []
    let urls = []
    if (linkName.length && linkUrl.length) {
        for (let i = 0; i < linkName.length; i++) {
            names.push(linkName[i].value)
            urls.push(linkUrl[i].value)
        }
    }

    // set div all child elements value linkName , linkUrl
    let isTrue = true
    for (let i = 0; i < linkName.length; i++)
        if (linkName[i].value == '' || linkUrl[i].value == '') {
            isTrue = false
            break
        }

    if (!isTrue) {
        alert('Please fill all fields')
        return
    }
    let str = `
    <div class="my-2" style="border: 1px solid black; padding:10px">
        <div class="form-group ">
            <label>Link Name</label>
            <input name="LinkName[]" type="text" class="form-control"
                placeholder="Enter Link Name" required>
        </div>
        <div class="form-group">
            <label>Link URL</label>
            <input name="Link[]" type="text" class="form-control"
                placeholder="Enter Link URL" required>
        </div>
    </div>
    `
    //append variable to div
    div.innerHTML += str
    if (names.length && urls.length) {
        for (let i = 0; i < names.length; i++) {
            linkName[i].value = names[i]
            linkUrl[i].value = urls[i]
        }
    }
}
function Signup (url) {
    FData = new FormData(document.getElementById('SignupForm'))

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    })

    $.ajax({
        url: url,
        type: 'POST',
        data: FData,
        contentType: false,
        processData: false,
        success: function (data) {
            console.log(data)
            if (data.hasOwnProperty('errors')) {
                let errValues = Object.values(data.errors)
                let errStr = ''

                for (let i = 0; i < data.errors.length; i++)
                    errStr += errValues[i] + '<br>'

                $('div.Myfailure').html(errStr)
                $('div.Myfailure')
                    .fadeIn(300)
                    .delay(5000)
                    .fadeOut(400)
                $('html, body').animate(
                    {
                        scrollTop: $('div.Myfailure').offset().top - 250
                    },
                    100
                )
            } else if (data.hasOwnProperty('success')) {
                $('div.Mysuccess').html(data.success)
                $('div.Mysuccess')
                    .fadeIn(300)
                    .delay(5000)
                    .fadeOut(400)
                $('html, body').animate(
                    {
                        scrollTop: $('div.Mysuccess').offset().top - 250
                    },
                    100
                )
                //submit form
                document.getElementById('SignupForm').submit()
            }
        },
        error: function (data) {
            console.log(data)
            let errKeys = Object.keys(data.responseJSON.errors)
            let errValues = Object.values(data.responseJSON.errors)
            let errStr = ''
            for (let i = 0; i < errKeys.length; i++) {
                errStr += errKeys[i] + ' : ' + errValues[i][0] + '<br>'
            }
            $('div.Myfailure').html(errStr)
            $('div.Myfailure')
                .fadeIn(300)
                .delay(5000)
                .fadeOut(400)
            //center page scroll to div.Myfailure position
            $('html, body').animate(
                {
                    scrollTop: $('div.Myfailure').offset().top - 250
                },
                100
            )
        }
    })
}
