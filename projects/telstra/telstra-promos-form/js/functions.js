// Hides elementes using id
function hideElement(element,state){
  document.getElementById(element).hidden = state;
}

// Find if check box is checked and display element base on that, also unchecked childs if there are checked
function checkBoxOn(element,elementToHide,childs){
  let conCAplans = ['core-C_A'];
  let conNBNplans = ['core-NBN','core-ttv-NBN','unlimited-NBN',
                     'unlimited-ttv-NBN','premium','premium-super',
                     'premium-ultra'];
  let foxtelPlans = ['foxtelPlus','foxtelSports','foxtelMovies',
                     'foxtelPremium','foxtelPlatinum'];
  let plans5G = ['5g_plan'];
  let homePhonePlans = ['ultimateVoice'];
  let smbCAplans = ['business_CA'];
  let smbNBNplans = ['business_NBN','business_premium_NBN'];

  if (childs == 'conCAplans'){
    childs = conCAplans;
  }else if (childs == 'conNBNplans'){
    childs = conNBNplans;
  }else if (childs == 'foxtelPlans'){
    childs = foxtelPlans;
  }else if (childs == 'plans5G'){
    childs = plans5G;
  }else if (childs == 'homePhonePlans'){
    childs = homePhonePlans;
  }else if (childs == 'smbCAplans'){
    childs = smbCAplans;
  }else if (childs == 'smbNBNplans'){
    childs = smbNBNplans;
  }else{
    console.log('Error line 34');
  }
  
  let checkBox = document.getElementById(element);

  if (checkBox.checked == true){
    hideElement(elementToHide,false);
  }else{
    for (let i = 0; i < childs.length; i++){
      document.getElementById(childs[i]).checked = false;
    }
    hideElement(elementToHide,true);
  }
}

// Writes content using id
function putContent(element,content){
  document.getElementById(element).innerHTML = content;
}

// Run on the "Print Icon"
function printPage(){
  $('#printPDFDemostration').modal('show');
  // window.print();
}

function goToPrint(){
  $('#printPDFDemostration').modal('hide');
  window.print();
}

// Get the input from slect options (Mandatory field) GENERAL
function verifyApplied(element){
  let whoApply = document.getElementById(element);
  if (whoApply.value == "-Select one-"){
    return null;
  }else{
    return whoApply.value;
  }
}

// Gather info from radio buttons and Coded Promo if any MOBILITY
function verifyType(){
  let typeIncluded = document.getElementById("included");
  let typeCoded = document.getElementById("coded");
  if (typeIncluded.checked == false && typeCoded.checked == false){
    return null;
  }else{
    if (typeIncluded.checked == true){
      return "Included";
    }else{
      let promoCode = document.getElementById("promoCode");
      if (promoCode.value == ""){
        return null;
      }else{
        return "Coded: "+promoCode.value;
      }
    }
  }
}

// Gather info from radio buttons and Coded Promo if any FIXED
function verifyTypeF(){
  let typeIncludedA = document.getElementById("includedATLF");
  let typeIncludedB = document.getElementById("includedBTLF");
  let typeCodedF = document.getElementById("codedF");
  if (typeIncludedA.checked == false && typeIncludedB.checked == false && typeCodedF.checked == false){
    return null;
  }else{
    if (typeIncludedA.checked == true){
      return "Included ATL";
    }else if (typeIncludedB.checked == true){
      return "Included BTL";
    }else{
      let promoCodeF = document.getElementById("promoCodeF");
      if (promoCodeF.value == ""){
        return null;
      }else{
        return "Coded: "+promoCodeF.value;
      }
    }
  }
}

// Gather text imput from Name, Rules, Decives and Eamil (Name is mandatory) GENERAL
function verifyTextInput(elements){
  let textContent = [];
  for (let i = 0; i < elements.length; i++){
    let text = document.getElementById(elements[i]);
    textContent.push(text.value);
  }
  if (textContent[0] == ""){
    return null;
  }else{
    return textContent;
  }
}

// Collect start and end dates (Both input mandatory) GENERAL
function verifyDates(ids){
  let dates = []
  for (let i = 0; i < ids.length; i++){
    let date = document.getElementById(ids[i]);
    dates.push(date.value);
  }
  if (dates[0] == "" || dates[1] == ""){
    return null;
  }else{
    return dates;
  }
}

// Gather data from Check boxes GENERAL
function checkBoxesChecker(ids,names){
  let results = [];
  for (let i = 0; i < ids.length; i++){
    let checkValue = document.getElementById(ids[i]);
    if (checkValue.checked == true){
      results.push(names[i]);
    }
  }
  if (results.length == 0){
    return null;
  }else{
    return results;
  }
}

// Run on the "Checked icon" MOBILITY
function showSummary(){
  // Validates all data entered by user
  let applied = verifyApplied("appliedBy");
  if (applied != null){
    putContent("applied",applied)
  }else{
    alert("Please select an option for 'Applied by'");
    return false;
  }
  let type = verifyType();
  if (type != null){
    putContent("type",type)
  }else{
    alert("Please select an option for 'Type'");
    return false;
  }

  let ids = ["displayName","businessRule","devices","emailNotify","stockOnHand"];
  let textFields = verifyTextInput(ids);
  if (textFields != null){
    let name = textFields[0];
    let rules = textFields[1];
    let devices = textFields[2];
    let emailNoty = textFields[3];
    let stockOnHand = textFields[4];
    putContent("name",name);
    putContent("rules",rules);
    putContent("devicesSumary",devices);
    putContent("emailNotifySummary",emailNoty)
    putContent("stockOnHandSum",stockOnHand);
  }else{
    alert("Please select an option for 'Display Name'");
    return false;
  }
  
  let idsSegment = ["segCon","segSmb"];
  let namesSegments = ["CON","SMB"];
  let idsOrderType = ["new","porting","recon"];
  let namesOrderType = ["New","Porting","Recon"];
  let idsPricePoint = ["mobileS","mobileM","mobileL","mobileXL",
                       "tabletXS","tabletS","tabletM","tabletL",
                       "mbbXS","mbbS","mbbM","mbbL"];
  let namesPricePoint = ["Mobile S","Mobile M","Mobile L","Mobile XL",
                         "Tablet XS","Tablet S","Tablet M","Tablet L",
                         "Mbb XS","Mbb S","Mbb M","Mbb L"];

  let segment = checkBoxesChecker(idsSegment,namesSegments);
  if (segment != null){
    putContent("segmentSum",segment);
  }else{
    alert("Please choose at least one segment");
    return false;
  }
  let ortdeType = checkBoxesChecker(idsOrderType,namesOrderType);
  let pricePoint = checkBoxesChecker(idsPricePoint,namesPricePoint);
  putContent("orderType",ortdeType);
  putContent("pricePoint",pricePoint);

  let idsDates  = ["startDate","endDate"];
  let dates = verifyDates(idsDates);
  if (dates != null){
    putContent("starts",dates[0]);
    putContent("ends",dates[1]);
  }else{
    alert("Please enter 'start' and 'end' dates");
    return false;
  }
  // Hides Selection Menu and displays the Summary
  hideElement("selctionMenu",true);
  hideElement("summary",false);
  // Modifies the icons on the menu
  hideElement("editSummary",false);
  hideElement("checkIcon",true);
  hideElement("printIcon",false);
}

// Run on the "Edit Icon"
function editContent(){
  // Hides the Summary and brings back the Selection Menu
  hideElement("summary",true);
  hideElement("selctionMenu",false);
  // Modifies the icons on the menu
  hideElement("editSummary",true);
  hideElement("checkIcon",false);
  hideElement("printIcon",true);
}

// Run on the "Checked icon" FIXED
function showSummaryF(){

  let applied = verifyApplied("appliedByF");
  if (applied != null){
    putContent("appliedF",applied)
  }else{
    alert("Please select an option for 'Applied by'");
    return false;
  }

  let type = verifyTypeF();
  if (type != null){
    putContent("typeF",type)
  }else{
    alert("Please select an option for 'Type'");
    return false;
  }

  let ids = ["displayNameF","creditAmountF","discountPeriodF"];
  let textFields = verifyTextInput(ids);
  if (textFields != null){
    let name = textFields[0];
    let credit = textFields[1];
    let period = textFields[2];
    putContent("nameF",name);
    putContent("creditF",credit);
    putContent("disountF",period);
  }else{
    alert("Please select an option for 'Display Name'");
    return false;
  }

  let idsOrderType = ["newF","portingF","existingF"];
  let namesOrderType = ["New","Porting","Existing-recon"];
  let orderType = checkBoxesChecker(idsOrderType,namesOrderType);
  putContent('orderTypeF',orderType);

  let idsDates  = ["startDateF","endDateF"];
  let dates = verifyDates(idsDates);
  if (dates != null){
    putContent("startsF",dates[0]);
    putContent("endsF",dates[1]);
  }else{
    alert("Please enter 'start' and 'end' dates");
    return false;
  }

  let idsSalesChannels = ["cableAdls","nbn","foxtel","5g","homePhone","smb_cableAdls","smb_nbn"];
  let namesSalesChannels = ["CABLE/ADLS","NBN","FOXTEL","5G","HOME PHONE","SMB CABLE/ADSL","SMB NBN"];
  let salesChannels = checkBoxesChecker(idsSalesChannels,namesSalesChannels);
  putContent('salesChannelsF',salesChannels)

  let idsPlans = ['core-C_A','core-NBN','core-ttv-NBN','unlimited-NBN',
                  'unlimited-ttv-NBN','premium','premium-super','premium-ultra',
                  'foxtelPlus','foxtelSports','foxtelMovies','foxtelPremium',
                  'foxtelPlatinum','5g_plan','ultimateVoice','business_CA',
                  'business_NBN','business_premium_NBN'];
  let namesPlans = ['Core ADLS','Core NBN','Core ttv NBN','Unlimited NBN',
                  'Unlimited Ttv NBN','Premium','premium super','Premium ultra',
                  'Foxtel Plus','Foxtel Sports','Foxtel Movies','Foxtel Premium',
                  'Foxtel Platinum','5G Home Internet','Ultimate Voice','SMB ADLS',
                  'SMB NBN','SMB premium NBN'];
  let plans = checkBoxesChecker(idsPlans,namesPlans);
  putContent('plansF',plans)

  hideElement('summaryF',false);
  hideElement('selctionMenuF',true);
  hideElement("editSummary",false);
  hideElement("checkIcon",true);
  hideElement("printIcon",false);
}
// Run on the "Edit Icon"
function editContentF(){
  // Hides the Summary and brings back the Selection Menu
  hideElement("summaryF",true);
  hideElement("selctionMenuF",false);
  // Modifies the icons on the menu
  hideElement("editSummary",true);
  hideElement("checkIcon",false);
  hideElement("printIcon",true);
}

var countDevice  = 0;

function addColor(btn){
  countDevice++;
  let btnId = (btn.id).toString();
  let countId = btnId.replace("addC","");
  let deviceId = btnId.replace("addC","color");
  console.log(deviceId);
  $("#"+deviceId).append('<div class="row">'+
                            '<div class="col-3">'+
                              '<label for="orinSku-'+countId+countDevice.toString()+'" class="form-label">ORIN SKU:</label>'+
                              '<input type="text" id="orinSku-'+countId+countDevice.toString()+'" class="form-control" placeholder="e.g. 100248887">'+
                            '</div>'+
                            '<div class="col-3">'+
                              '<label for="productColor-'+countId+countDevice.toString()+'" class="form-label">Product Color:</label>'+
                              '<input type="text" id="productColor-'+countId+countDevice.toString()+'" class="form-control" placeholder="e.g. Black">'+
                            '</div>'+
                          '</div>');
}


function deletePrice(btn){
  let btnId = (btn.id).toString();
  let priceId = btnId.replace("binP","price")
  console.log(priceId);
  $("#"+priceId).remove();
}

function deleteVariant(btn){
  let btnId = (btn.id).toString();
  let variantId = btnId.replace("bin","variant")
  console.log(variantId);
  $("#"+variantId).remove();
}

function getUserInputs(inputClass){
  var inputs = $(inputClass);
  var userSelection = [];
  for (var i = 0; i < inputs.length; i++){
    userSelection.push([$(inputs[i]).val(),$(inputs[i]).attr("id")]);
  }
  console.log(userSelection);
}

function readUserInput(InputName,id,mandatory=Boolean,denyString=null){
  var input = $(id);
  var resultVal = $(input).val();
  if (mandatory == true){
    if ((resultVal == "")||(resultVal == denyString)){
      alert('Please enter an option for: '+InputName);
      return null;
    }else{
      return resultVal;
    }
  }
  return resultVal;
}


function readSegment(){
  var checkBoxInputs = $("#segmentND .form-check-input");
  var checkBoxLabels = $("#segmentND .form-check-label");
  var optionsSelected = [];

  for(var i = 0; i < checkBoxInputs.length; i++){
    if ($(checkBoxInputs[i]).is(":checked")==true){
      if ($(checkBoxInputs[i]).attr("id") == $(checkBoxLabels[i]).attr("for")){
        optionsSelected.push($(checkBoxLabels[i]).text());
      }
    }
  }
  console.log(optionsSelected);
  if (optionsSelected.length != 0){
    console.log('at least one option found');
  }else{
    alert('Please select at least one "Segment"');
    return false;
  }
  $("#sumSegmentND").text(optionsSelected.toString());
}



function creatHtml(list){
  var devices = (list.length - 3) / 2;
  var rrp = parseFloat(list[1]);
  var mro12 = (rrp/12).toFixed(2).toString();
  var mro24 = (rrp/24).toFixed(2).toString();
  var mro36 = (rrp/36).toFixed(2).toString();
  
  
  var html1 = '<div class="headPrice">'+
                '<label for="">Device: &emsp;'+list[0]+'</label><br>'+
                '<label for="">RPP: &emsp;&emsp;'+list[1]+'</label><br>'+
                '<label for="">mro12: &emsp;'+mro12+'</label><br>'+
                '<label for="">mro24: &emsp;'+mro24+'</label><br>'+
                '<label for="">mro36: &emsp;'+mro36+'</label><br>'+
                '<label for="">Siebel: &emsp;'+list[2]+'</label>'+
              '</div>'+
              '<table class="table">'+
              '<thead>'+
                '<tr>'+
                  '<th scope="col">ORIN</th>'+
                  '<th scope="col">COLOR</th>'+
                '</tr>'+
              '</thead>'+
              '<tbody>';  
  
  var html2 = '';
  var a = 3;
  var b = 4;

  for(var i = 0; i < devices; i++){    
    var sub = '<tr>'+
                '<td>'+list[a]+'</td>'+
                '<td>'+list[b]+'</td>'+
              '</tr>';


    html2 = html2.concat(sub);
    a = a + 2;
    b = b + 2;
  
  }

  var html3 = '</tbody>'+
            '</table>';

  console.log(devices);

  var semiResult = html1.concat(html2);
  var result = semiResult.concat(html3);

  console.log(result);

  return result;
}


function readDevicesInfo(){
  var objectT = [];
  var flags = [];
  var firstRrp = [];
  var inputs = $(".row2 .form-control");
  // finds how many prices variants there are
  for(var i = 0; i < inputs.length; i++){
    console.log($(inputs[i]).val(),$(inputs[i]).attr("id"));
    if (($(inputs[i]).attr("id")).includes("rrp")){
      firstRrp.push($(inputs[i]).attr("id"));
    }      
  }
  // goes trough each group variant to build an array with numbers indicators
  for(var j = 0; j <firstRrp.length; j++){
    var tables = [];
    let temp = firstRrp[j].replace("rrp","");      
    flags.push(temp);
    // depeding on the number indicators will creat a list with all values for each variant
    for(var k = 0; k < inputs.length; k++){
      if(($(inputs[k]).attr("id")).includes(flags[j])){
        tables.push($(inputs[k]).val());
      }
    }
    // creates a list of sublists that contain all variants
    objectT.push(tables);
  }
  console.log(objectT);
  return objectT;
}

$(document).ready(function(){
  var countId = 0;

  $("#addDeviceVariant").click(function(){
    countId++;
    // html code for pricing
    // Add price point with bin option to be removed
    $(".row2").append('<div id="price'+countId.toString()+'">'+
                        '<div class="row">'+
                          '<div class="col-6">'+
                            '<label for="theDevice-'+countId.toString()+'" class="form-label">Device:</label>'+
                            '<input type="text" id="theDevice-'+countId.toString()+'" class="form-control" placeholder="e.g. Samsung Galaxy S22 5G 128GB">'+
                          '</div>'+
                          '<div class="col-3">'+
                            '<label for="rrp-'+countId.toString()+'" class="form-label">RRP (Inc GST):</label>'+
                            '<input type="text" id="rrp-'+countId.toString()+'" class="form-control" placeholder="e.g. 1249">'+
                          '</div>'+
                          '<div class="col-3">'+
                            '<label for="siebelPartNo-'+countId.toString()+'" class="form-label">Siebel Part No:</label>'+
                            '<input type="text" id="siebelPartNo-'+countId.toString()+'" class="form-control" placeholder="e.g. PHS0000490">'+
                          '</div>'+
                        '</div>'+
                        '<div id="color'+countId.toString()+'">'+
                        '</div>'+
                        '<div class="functButton">'+
                          '<button onclick="addColor(this)" id="addC'+countId.toString()+'" type="button" class="btn btn-primary">Add Color</button>'+
                        '</div>'+
                        '<div class="functButton">'+
                          '<button onclick="deletePrice(this)" id="binP'+countId.toString()+'" type="button" class="btn btn-primary"><i class="fas fa-trash-alt"></i></button>'+
                        '</div>'+
                      '</div>');
  });  
  
  

  // Hide the selection menu and show the summary with "edit" and "save"
  $("#reviewNewDeviceButt").click(function(){
    if (readSegment()==false){
      return false;
    }
    
    var statusAtLaunch = readUserInput('Status at Launch',"#statusAtLaunch",true,'-Select one-');
    var launchDate = readUserInput('Launch Date',"#launchStartDate",true);
    var stockNotice = readUserInput('Stock Notice',"#stockNotice",true);
    var imageLinks = readUserInput('Images Links',"#deviceImages",false)

    if ($("#statusAtLaunch").val() == 'preOrder'){
      var preLaunchDate = readUserInput('Pre-launch Date','#preLaunchDate',true);
      if (preLaunchDate != null){
        $("#sumPreLaunchDateND").text(preLaunchDate);
      }else{
        return false;
      }

    }else{
      $("#sumPreLaunchDateND").text('na');

    }
    
    if ((statusAtLaunch == null)||(launchDate == null)||(stockNotice == null)){
      return false;
    }else{
      $("#sumStatusAtLaunchND").text(statusAtLaunch);
      $("#sumLaunchDateND").text(launchDate);
      $("#sumStockNoticeND").text(stockNotice);
    }

    $("#sumImageLinksND").text(imageLinks);

    // reads devices info from user inputs
    var devcivesObject = readDevicesInfo();
    var htmlT = [];
    for(var i = 0; i < devcivesObject.length; i++){
      htmlT.push(creatHtml(devcivesObject[i]));
    }
    // writes info into tables on review page
    $("#sumDevicesND").empty();
     for(var j = 0; j < htmlT.length; j++){
       $("#sumDevicesND").append(htmlT[j]);
     }
    


    $("#selctionMenuND").hide();
    $("#checkIcon").hide();
    $("#summaryND").removeAttr('hidden');
    $("#editSummary").removeAttr('hidden');
    $("#printIcon").removeAttr('hidden');
  });
  // Go back to edit page, show the selection-menu, review-icon and hide: save and edit
  $("#editNewDevice").click(function(){
    $("#selctionMenuND").show();
    $("#checkIcon").show();
    $("#summaryND").attr('hidden','true');
    $("#editSummary").attr('hidden','true');
    $("#printIcon").attr('hidden','true');
  });

  $("#statusAtLaunch").change(function(){
    if ($(this).val() == 'preOrder'){
      $("#preOrderDate").removeAttr('hidden');
    }else{
      $("#preOrderDate").attr('hidden','true');
    }

    console.log($(this).val());
    console.log($("#statusAtLaunch option:selected").text());
  });

});