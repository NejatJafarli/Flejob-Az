function MyFunc1(e){let l=document.getElementById("CompanyExp"),t=document.getElementsByName("companyname[]"),a=document.getElementsByName("companyrank[]"),n=document.getElementsByName("companyEnddate[]"),r=document.getElementsByName("companyStartdate[]"),o=[],s=[],i=[],u=[];if(t.length&&a.length&&n.length&&r.length)for(let d=0;d<t.length;d++)o.push(t[d].value),s.push(a[d].value),i.push(n[d].value),u.push(r[d].value);let c=!0;for(let m=0;m<t.length;m++)if(""==t[m].value||""==a[m].value||""==r[m].value||""==n[m].value){c=!1;break}if(!c){alert("Please fill all the fields");return}let p=` <div class="my-2" style="border: 1px solid black; padding:10px">
    <div class="close-btn"  style="text-align:end;">
        <button type="button" class="btn btn-danger" onclick="this.parentNode.parentNode.remove()"><i class="fa-solid fa-xmark"></i></button>
    </div>
    <div class="form-group ">
        <label>${e[0]}</label>
        <input name="companyname[]" type="text" class="form-control"
            placeholder="${e[1]}" required>
    </div>
    <div class="form-group">
        <label>${e[2]}</label>
        <input name="companyrank[]" type="text" class="form-control"
            placeholder="${e[3]}" required>
    </div>
    <div class="form-group">
        <label>${e[4]}</label>
        <input name="companyStartdate[]" type="date" class="form-control"
            required>
    </div>
    <div class="form-group">
        <label>${e[5]}</label>
        <input name="companyEnddate[]" type="date" class="form-control"
        required>
    </div>
</div>
`;if(l.innerHTML+=p,o.length&&s.length&&i.length&&u.length)for(let f=0;f<o.length;f++)t[f].value=o[f],a[f].value=s[f],n[f].value=i[f],r[f].value=u[f]}function MyFunc2(e,l,t){let a=document.getElementById("Education"),n=document.getElementsByName("educationName[]"),r=document.getElementsByName("educationYearStart[]"),o=document.getElementsByName("educationYearEnd[]"),s=document.getElementsByName("educationLevel[]"),i=[],u=[],d=[],c=[];if(n.length&&r.length&&s.length&&o.length)for(let m=0;m<n.length;m++)i.push(n[m].value),u.push(r[m].value),d.push(o[m].value),c.push(s[m].value);let p=!0;for(let f=0;f<n.length;f++)if(""==n[f].value||""==r[f].value||""==o[f].value||""==s[f].value){p=!1;break}if(!p){alert("Please fill all fields");return}let y=`
    <div class="my-2" style="border: 1px solid black; padding:10px">
        <div class="close-btn"  style="text-align:end;">
            <button type="button" class="btn btn-danger" onclick="this.parentNode.parentNode.remove()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="form-group ">
            <label>${t[0]}</label>
            <input name="educationName[]" type="text" class="form-control"
                placeholder="${t[1]}" required>
        </div>
        <div class="form-group">
            <label>${t[2]}</label>
            <input name="educationYearStart[]" type="number" maxlength="4" class="form-control"
            placeholder="${t[3]}" required>
        </div>

        <div class="form-group">
            <label>${t[4]}</label>
            <input name="educationYearEnd[]" type="number" maxlength="4" class="form-control"
            placeholder="${t[5]}" required>
        </div>
                
        <div class="form-group">
            <label>${t[6]}</label>
            <select name="educationLevel[]" class="form-control">
            `;for(let v=0;v<e.length;v++)y+=`<option value="${l[v]}">${e[v]}</option>`;if(y+=`
            </select>
        </div>
    </div>
    `,a.innerHTML+=y,i.length&&u.length&&c.length&&d.length)for(let g=0;g<i.length;g++)n[g].value=i[g],r[g].value=u[g],o[g].value=d[g],s[g].value=c[g]}function MyFunc3(e){let l=document.getElementById("Links"),t=document.getElementsByName("LinkName[]"),a=document.getElementsByName("Link[]"),n=[],r=[];if(t.length&&a.length)for(let o=0;o<t.length;o++)n.push(t[o].value),r.push(a[o].value);let s=!0;for(let i=0;i<t.length;i++)if(""==t[i].value||""==a[i].value){s=!1;break}if(!s){alert("Please fill all fields");return}let u=`
    <div class="my-2" style="border: 1px solid black; padding:10px">
        <div class="close-btn"  style="text-align:end;">
            <button type="button" class="btn btn-danger" onclick="this.parentNode.parentNode.remove()"><i class="fa-solid fa-xmark"></i></button>
        </div>
        <div class="form-group ">
            <label>${e[0]}</label>
            <input name="LinkName[]" type="text" class="form-control"
                placeholder="${e[1]}" required>
        </div>
        <div class="form-group">
            <label>${e[2]}</label>
            <input name="Link[]" type="text" class="form-control"
                placeholder="${e[3]}" required>
        </div>
    </div>
    `;if(l.innerHTML+=u,n.length&&r.length)for(let d=0;d<n.length;d++)t[d].value=n[d],a[d].value=r[d]}function MyFunc4(e){let l=document.getElementById("Phones"),t=document.getElementsByName("CompanyPhone[]"),a=[];if(t.length)for(let n=0;n<t.length;n++)a.push(t[n].value);let r=!0;for(let o=0;o<t.length;o++)if(t[o].value.includes("_")){r=!1;break}if(!r){alert("Please fill all fields");return}let s=`<div class="form-group pt-3">
    <label>${e[0]}: +994xxxxxxxxx</label>
    <input type="text" name="CompanyPhone[]" class="form-control MaskPhone"
        placeholder="${e[1]}" value="+994" >
</div>`;if(l.innerHTML+=s,a.length)for(let i=0;i<a.length;i++)t[i].value=a[i];$(".MaskPhone").inputmask("+\\9\\94999999999")}function Signup(e){FData=new FormData(document.getElementById("SignupForm")),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$.ajax({url:e,type:"POST",data:FData,contentType:!1,processData:!1,success:function(e){if(console.log(e),e.hasOwnProperty("errors")){let l=Object.values(e.errors),t="";for(let a=0;a<e.errors.length;a++)t+=l[a]+"<br>";$("div.Myfailure").html(t),$("div.Myfailure").fadeIn(300).delay(5e3).fadeOut(400),$("html, body").animate({scrollTop:$("div.Myfailure").offset().top-250},100)}else e.hasOwnProperty("success")&&($("div.Mysuccess").html(e.success),$("div.Mysuccess").fadeIn(300).delay(5e3).fadeOut(400),$("html, body").animate({scrollTop:$("div.Mysuccess").offset().top-250},100),document.getElementById("SignupForm").submit())},error:function(e){console.log(e);let l=Object.keys(e.responseJSON.errors),t=Object.values(e.responseJSON.errors),a="";for(let n=0;n<l.length;n++)a+=l[n]+" : "+t[n][0]+"<br>";$("div.Myfailure").html(a),$("div.Myfailure").fadeIn(300).delay(5e3).fadeOut(400),$("html, body").animate({scrollTop:$("div.Myfailure").offset().top-250},100)}})}function SignupCompany(e){FData=new FormData(document.getElementById("SignupFormCompany")),$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$.ajax({url:e,type:"POST",data:FData,contentType:!1,processData:!1,success:function(e){if(e.hasOwnProperty("errors")){let l=Object.values(e.errors),t="";for(let a=0;a<e.errors.length;a++)t+=l[a]+"<br>";$("div.Myfailure").html(t),$("div.Myfailure").fadeIn(300).delay(5e3).fadeOut(400),$("html, body").animate({scrollTop:$("div.Myfailure").offset().top-250},100)}else e.hasOwnProperty("success")&&($("div.Mysuccess").html(e.success),$("div.Mysuccess").fadeIn(300).delay(5e3).fadeOut(400),$("html, body").animate({scrollTop:$("div.Mysuccess").offset().top-250},100),document.getElementById("SignupFormCompany").submit())},error:function(e){let l=Object.keys(e.responseJSON.errors),t=Object.values(e.responseJSON.errors),a="";for(let n=0;n<l.length;n++)a+=l[n]+" : "+t[n][0]+"<br>";$("div.Myfailure").html(a),$("div.Myfailure").fadeIn(300).delay(5e3).fadeOut(400),$("html, body").animate({scrollTop:$("div.Myfailure").offset().top-250},100)}})}