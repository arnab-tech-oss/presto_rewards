function getChartColorsArray(e){if(console.log(e),null!==document.getElementById(e)){var t=document.getElementById(e).getAttribute("data-colors");return(t=JSON.parse(t)).map(function(e){var t=e.replace(" ","");if(-1===t.indexOf(",")){var a=getComputedStyle(document.documentElement).getPropertyValue(t);return a||t}var r=e.split(",");return 2!=r.length?t:"rgba("+getComputedStyle(document.documentElement).getPropertyValue(r[0])+","+r[1]+")"})}}var chartBarColors=getChartColorsArray("area_chart_basic"),options={series:[{name:"STOCK ABC",data:series.monthDataSeries1.prices}],chart:{type:"area",height:350,zoom:{enabled:!1}},dataLabels:{enabled:!1},stroke:{curve:"straight"},title:{text:"Fundamental Analysis of Stocks",align:"left",style:{fontWeight:500}},subtitle:{text:"Price Movements",align:"left"},labels:series.monthDataSeries1.dates,xaxis:{type:"datetime"},yaxis:{opposite:!0},legend:{horizontalAlign:"left"},colors:chartBarColors},chart=new ApexCharts(document.querySelector("#area_chart_basic"),options);chart.render();options={series:[{name:"series1",data:[31,40,28,51,42,109,100]},{name:"series2",data:[11,32,45,32,34,52,41]}],chart:{height:350,type:"area"},dataLabels:{enabled:!1},stroke:{curve:"smooth"},colors:chartBarColors=getChartColorsArray("area_chart_spline"),xaxis:{type:"datetime",categories:["2018-09-19T00:00:00.000Z","2018-09-19T01:30:00.000Z","2018-09-19T02:30:00.000Z","2018-09-19T03:30:00.000Z","2018-09-19T04:30:00.000Z","2018-09-19T05:30:00.000Z","2018-09-19T06:30:00.000Z"]},tooltip:{x:{format:"dd/MM/yy HH:mm"}}};(chart=new ApexCharts(document.querySelector("#area_chart_spline"),options)).render();var timelinechart={series:[{data:[[13273596e5,30.95],[1327446e6,31.34],[13275324e5,31.18],[13276188e5,31.05],[1327878e6,31],[13279644e5,30.95],[13280508e5,31.24],[13281372e5,31.29],[13282236e5,31.85],[13284828e5,31.86],[13285692e5,32.28],[13286556e5,32.1],[1328742e6,32.65],[13288284e5,32.21],[13290876e5,32.35],[1329174e6,32.44],[13292604e5,32.46],[13293468e5,32.86],[13294332e5,32.75],[13297788e5,32.54],[13298652e5,32.33],[13299516e5,32.97],[1330038e6,33.41],[13302972e5,33.27],[13303836e5,33.27],[133047e7,32.89],[13305564e5,33.1],[13306428e5,33.73],[1330902e6,33.22],[13309884e5,31.99],[13310748e5,32.41],[13311612e5,33.05],[13312476e5,33.64],[13315068e5,33.56],[13315932e5,34.22],[13316796e5,33.77],[1331766e6,34.17],[13318524e5,33.82],[13321116e5,34.51],[1332198e6,33.16],[13322844e5,33.56],[13323708e5,33.71],[13324572e5,33.81],[13327128e5,34.4],[13327992e5,34.63],[13328856e5,34.46],[1332972e6,34.48],[13330584e5,34.31],[13333176e5,34.7],[1333404e6,34.31],[13334904e5,33.46],[13335768e5,33.59],[13339224e5,33.22],[13340088e5,32.61],[13340952e5,33.01],[13341816e5,33.55],[1334268e6,33.18],[13345272e5,32.84],[13346136e5,33.84],[13347e8,33.39],[13347864e5,32.91],[13348728e5,33.06],[1335132e6,32.62],[13352184e5,32.4],[13353048e5,33.13],[13353912e5,33.26],[13354776e5,33.58],[13357368e5,33.55],[13358232e5,33.77],[13359096e5,33.76],[1335996e6,33.32],[13360824e5,32.61],[13363416e5,32.52],[1336428e6,32.67],[13365144e5,32.52],[13366008e5,31.92],[13366872e5,32.2],[13369464e5,32.23],[13370328e5,32.33],[13371192e5,32.36],[13372056e5,32.01],[1337292e6,31.31],[13375512e5,32.01],[13376376e5,32.01],[1337724e6,32.18],[13378104e5,31.54],[13378968e5,31.6],[13382424e5,32.05],[13383288e5,31.29],[13384152e5,31.05],[13385016e5,29.82],[13387608e5,30.31],[13388472e5,30.7],[13389336e5,31.69],[133902e7,31.32],[13391064e5,31.65],[13393656e5,31.13],[1339452e6,31.77],[13395384e5,31.79],[13396248e5,31.67],[13397112e5,32.39],[13399704e5,32.63],[13400568e5,32.89],[13401432e5,31.99],[13402296e5,31.23],[1340316e6,31.57],[13405752e5,30.84],[13406616e5,31.07],[1340748e6,31.41],[13408344e5,31.17],[13409208e5,32.37],[134118e7,32.19],[13412664e5,32.51],[13414392e5,32.53],[13415256e5,31.37],[13417848e5,30.43],[13418712e5,30.44],[13419576e5,30.2],[1342044e6,30.14],[13421304e5,30.65],[13423896e5,30.4],[1342476e6,30.65],[13425624e5,31.43],[13426488e5,31.89],[13427352e5,31.38],[13429944e5,30.64],[13430808e5,30.02],[13431672e5,30.33],[13432536e5,30.95],[134334e7,31.89],[13435992e5,31.01],[13436856e5,30.88],[1343772e6,30.69],[13438584e5,30.58],[13439448e5,32.02],[1344204e6,32.14],[13442904e5,32.37],[13443768e5,32.51],[13444632e5,32.65],[13445496e5,32.64],[13448088e5,32.27],[13448952e5,32.1],[13449816e5,32.91],[1345068e6,33.65],[13451544e5,33.8],[13454136e5,33.92],[13455e8,33.75],[13455864e5,33.84],[13456728e5,33.5],[13457592e5,32.26],[13460184e5,32.32],[13461048e5,32.06],[13461912e5,31.96],[13462776e5,31.46],[1346364e6,31.27],[13467096e5,31.43],[1346796e6,32.26],[13468824e5,32.79],[13469688e5,32.46],[1347228e6,32.13],[13473144e5,32.43],[13474008e5,32.42],[13474872e5,32.81],[13475736e5,33.34],[13478328e5,33.41],[13479192e5,32.57],[13480056e5,33.12],[1348092e6,34.53],[13481784e5,33.83],[13484376e5,33.41],[1348524e6,32.9],[13486104e5,32.53],[13486968e5,32.8],[13487832e5,32.44],[13490424e5,32.62],[13491288e5,32.57],[13492152e5,32.6],[13493016e5,32.68],[1349388e6,32.47],[13496472e5,32.23],[13497336e5,31.68],[134982e7,31.51],[13499064e5,31.78],[13499928e5,31.94],[1350252e6,32.33],[13503384e5,33.24],[13504248e5,33.44],[13505112e5,33.48],[13505976e5,33.24],[13508568e5,33.49],[13509432e5,33.31],[13510296e5,33.36],[1351116e6,33.4],[13512024e5,34.01],[1351638e6,34.02],[13517244e5,34.36],[13518108e5,34.39],[135207e7,34.24],[13521564e5,34.39],[13522428e5,33.47],[13523292e5,32.98],[13524156e5,32.9],[13526748e5,32.7],[13527612e5,32.54],[13528476e5,32.23],[1352934e6,32.64],[13530204e5,32.65],[13532796e5,32.92],[1353366e6,32.64],[13534524e5,32.84],[13536252e5,33.4],[13538844e5,33.3],[13539708e5,33.18],[13540572e5,33.88],[13541436e5,34.09],[135423e7,34.61],[13544892e5,34.7],[13545756e5,35.3],[1354662e6,35.4],[13547484e5,35.14],[13548348e5,35.48],[1355094e6,35.75],[13551804e5,35.54],[13552668e5,35.96],[13553532e5,35.53],[13554396e5,37.56],[13556988e5,37.42],[13557852e5,37.49],[13558716e5,38.09],[1355958e6,37.87],[13560444e5,37.71],[13563036e5,37.53],[13564764e5,37.55],[13565628e5,37.3],[13566492e5,36.9],[13569084e5,37.68],[13570812e5,38.34],[13571676e5,37.75],[1357254e6,38.13],[13575132e5,37.94],[13575996e5,38.14],[1357686e6,38.66],[13577724e5,38.62],[13578588e5,38.09],[1358118e6,38.16],[13582044e5,38.15],[13582908e5,37.88],[13583772e5,37.73],[13584636e5,37.98],[13588092e5,37.95],[13588956e5,38.25],[1358982e6,38.1],[13590684e5,38.32],[13593276e5,38.24],[1359414e6,38.52],[13595004e5,37.94],[13595868e5,37.83],[13596732e5,38.34],[13599324e5,38.1],[13600188e5,38.51],[13601052e5,38.4],[13601916e5,38.07],[1360278e6,39.12],[13605372e5,38.64],[13606236e5,38.89],[136071e7,38.81],[13607964e5,38.61],[13608828e5,38.63],[13612284e5,38.99],[13613148e5,38.77],[13614012e5,38.34],[13614876e5,38.55],[13617468e5,38.11],[13618332e5,38.59],[13619196e5,39.6]]}],chart:{id:"area-datetime",type:"area",height:320,zoom:{autoScaleYaxis:!0},toolbar:{show:!1}},colors:chartBarColors=getChartColorsArray("area_chart_datetime"),annotations:{yaxis:[{y:30,borderColor:"#999",label:{show:!0,text:"Support",style:{color:"#fff",background:"#e83e8c"}}}],xaxis:[{x:new Date("14 Nov 2012").getTime(),borderColor:"#999",yAxisIndex:0,label:{show:!0,text:"Rally",style:{color:"#fff",background:"#564ab1"}}}]},dataLabels:{enabled:!1},markers:{size:0,style:"hollow"},xaxis:{type:"datetime",min:new Date("01 Mar 2012").getTime(),tickAmount:6},tooltip:{x:{format:"dd MMM yyyy"}},fill:{type:"gradient",gradient:{shadeIntensity:1,inverseColors:!1,opacityFrom:.45,opacityTo:.05,stops:[20,100,100,100]}}};(timelinechart=new ApexCharts(document.querySelector("#area_chart_datetime"),timelinechart)).render();var resetCssClasses=function(e){var t=document.querySelectorAll(".timeline");Array.prototype.forEach.call(t,function(e){e.classList.remove("active")}),e.target.classList.add("active")};document.querySelector("#one_month").addEventListener("click",function(e){resetCssClasses(e),timelinechart.zoomX(new Date("28 Jan 2013").getTime(),new Date("27 Feb 2013").getTime())}),document.querySelector("#six_months").addEventListener("click",function(e){resetCssClasses(e),timelinechart.zoomX(new Date("27 Sep 2012").getTime(),new Date("27 Feb 2013").getTime())}),document.querySelector("#one_year").addEventListener("click",function(e){resetCssClasses(e),timelinechart.zoomX(new Date("27 Feb 2012").getTime(),new Date("27 Feb 2013").getTime())}),document.querySelector("#all").addEventListener("click",function(e){resetCssClasses(e),timelinechart.zoomX(new Date("23 Jan 2012").getTime(),new Date("27 Feb 2013").getTime())});options={series:[{name:"North",data:[{x:1996,y:322},{x:1997,y:324},{x:1998,y:329},{x:1999,y:342},{x:2e3,y:348},{x:2001,y:334},{x:2002,y:325},{x:2003,y:316},{x:2004,y:318},{x:2005,y:330},{x:2006,y:355},{x:2007,y:366},{x:2008,y:337},{x:2009,y:352},{x:2010,y:377},{x:2011,y:383},{x:2012,y:344},{x:2013,y:366},{x:2014,y:389},{x:2015,y:334}]},{name:"South",data:[{x:1996,y:162},{x:1997,y:90},{x:1998,y:50},{x:1999,y:77},{x:2e3,y:35},{x:2001,y:-45},{x:2002,y:-88},{x:2003,y:-120},{x:2004,y:-156},{x:2005,y:-123},{x:2006,y:-88},{x:2007,y:-66},{x:2008,y:-45},{x:2009,y:-29},{x:2010,y:-45},{x:2011,y:-88},{x:2012,y:-132},{x:2013,y:-146},{x:2014,y:-169},{x:2015,y:-184}]}],chart:{type:"area",height:350},dataLabels:{enabled:!1},stroke:{curve:"straight"},title:{text:"Area with Negative Values",align:"left",style:{fontSize:"14px",fontWeight:500}},xaxis:{type:"datetime",axisBorder:{show:!1},axisTicks:{show:!1}},colors:chartBarColors=getChartColorsArray("area_chart_negative"),yaxis:{tickAmount:4,floating:!1,labels:{style:{colors:"#038edc"},offsetY:-7,offsetX:0},axisBorder:{show:!1},axisTicks:{show:!1}},fill:{opacity:.5},tooltip:{x:{format:"yyyy"},fixed:{enabled:!1,position:"topRight"}},grid:{yaxis:{lines:{offsetX:-30}},padding:{left:20}}};(chart=new ApexCharts(document.querySelector("#area_chart_negative"),options)).render();chartBarColors=getChartColorsArray("area_chart-months"),options={series:[{name:"commits",data:githubdata.series}],chart:{id:"chartyear",type:"area",height:130,toolbar:{show:!1,autoSelected:"pan"},events:{mounted:function(e){var t=document.querySelector(".cmeta span.commits"),a=e.getSeriesTotalXRange(e.w.globals.minX,e.w.globals.maxX);t.innerHTML=a},updated:function(e){var t=document.querySelector(".cmeta span.commits"),a=e.getSeriesTotalXRange(e.w.globals.minX,e.w.globals.maxX);t.innerHTML=a}}},colors:chartBarColors,stroke:{width:0,curve:"smooth"},dataLabels:{enabled:!1},fill:{opacity:1,type:"solid"},yaxis:{show:!1,tickAmount:3},xaxis:{type:"datetime"}};(chart=new ApexCharts(document.querySelector("#area_chart-months"),options)).render();var chartBarColors=getChartColorsArray("area_chart-years"),optionsYears={series:[{name:"commits",data:githubdata.series}],chart:{height:170,type:"area",toolbar:{autoSelected:"selection"},brush:{enabled:!0,target:"chartyear"},selection:{enabled:!0,xaxis:{min:new Date("26 Jan 2014").getTime(),max:new Date("29 Mar 2015").getTime()}}},colors:chartBarColors,dataLabels:{enabled:!1},stroke:{width:0,curve:"smooth"},fill:{opacity:1,type:"solid"},legend:{position:"top",horizontalAlign:"left"},xaxis:{type:"datetime"}},chartYears=new ApexCharts(document.querySelector("#area_chart-years"),optionsYears);chartYears.render();var generateDayWiseTimeSeries=function(e,t,a){for(var r=0,o=[];r<t;){var s=e,i=Math.floor(Math.random()*(a.max-a.min+1))+a.min;o.push([s,i]),e+=864e5,r++}return o},chartBarColors=getChartColorsArray("area_chart_stacked"),options={series:[{name:"South",data:generateDayWiseTimeSeries(new Date("11 Feb 2017 GMT").getTime(),20,{min:10,max:60})},{name:"North",data:generateDayWiseTimeSeries(new Date("11 Feb 2017 GMT").getTime(),20,{min:10,max:20})},{name:"Central",data:generateDayWiseTimeSeries(new Date("11 Feb 2017 GMT").getTime(),20,{min:10,max:15})}],chart:{type:"area",height:350,stacked:!0,events:{selection:function(e,t){console.log(new Date(t.xaxis.min))}}},colors:chartBarColors,dataLabels:{enabled:!1},stroke:{curve:"smooth"},fill:{type:"gradient",gradient:{opacityFrom:.6,opacityTo:.8}},legend:{position:"top",horizontalAlign:"left"},xaxis:{type:"datetime"}};(chart=new ApexCharts(document.querySelector("#area_chart_stacked"),options)).render();for(var ts1=13885344e5,ts2=13886208e5,ts3=13890528e5,dataSet=[[],[],[]],i=0;i<12;i++){var innerArr=[ts1+=864e5,dataSeries[2][i].value];dataSet[0].push(innerArr)}for(i=0;i<18;i++){innerArr=[ts2+=864e5,dataSeries[1][i].value];dataSet[1].push(innerArr)}for(i=0;i<12;i++){innerArr=[ts3+=864e5,dataSeries[0][i].value];dataSet[2].push(innerArr)}chartBarColors=getChartColorsArray("area_chart_irregular"),options={series:[{name:"PRODUCT A",data:dataSet[0]},{name:"PRODUCT B",data:dataSet[1]},{name:"PRODUCT C",data:dataSet[2]}],chart:{type:"area",stacked:!1,height:350,zoom:{enabled:!1},toolbar:{show:!1}},dataLabels:{enabled:!1},markers:{size:0},fill:{type:"gradient",gradient:{shadeIntensity:1,inverseColors:!1,opacityFrom:.45,opacityTo:.05,stops:[20,100,100,100]}},yaxis:{labels:{style:{colors:"#8e8da4"},offsetX:0,formatter:function(e){return(e/1e6).toFixed(2)}},axisBorder:{show:!1},axisTicks:{show:!1}},xaxis:{type:"datetime",tickAmount:8,min:new Date("01/01/2014").getTime(),max:new Date("01/20/2014").getTime(),labels:{rotate:-15,rotateAlways:!0,formatter:function(e,t){return moment(new Date(t)).format("DD MMM YYYY")}}},title:{text:"Irregular Data in Time Series",align:"left",offsetX:14,style:{fontWeight:500}},tooltip:{shared:!0},legend:{position:"top",horizontalAlign:"right",offsetX:-10},colors:chartBarColors};(chart=new ApexCharts(document.querySelector("#area_chart_irregular"),options)).render();options={series:[{name:"Network",data:[{x:"Dec 23 2017",y:null},{x:"Dec 24 2017",y:44},{x:"Dec 25 2017",y:31},{x:"Dec 26 2017",y:38},{x:"Dec 27 2017",y:null},{x:"Dec 28 2017",y:32},{x:"Dec 29 2017",y:55},{x:"Dec 30 2017",y:51},{x:"Dec 31 2017",y:67},{x:"Jan 01 2018",y:22},{x:"Jan 02 2018",y:34},{x:"Jan 03 2018",y:null},{x:"Jan 04 2018",y:null},{x:"Jan 05 2018",y:11},{x:"Jan 06 2018",y:4},{x:"Jan 07 2018",y:15},{x:"Jan 08 2018",y:null},{x:"Jan 09 2018",y:9},{x:"Jan 10 2018",y:34},{x:"Jan 11 2018",y:null},{x:"Jan 12 2018",y:null},{x:"Jan 13 2018",y:13},{x:"Jan 14 2018",y:null}]}],chart:{type:"area",height:350,animations:{enabled:!1},zoom:{enabled:!1},toolbar:{show:!1}},dataLabels:{enabled:!1},stroke:{curve:"straight"},fill:{opacity:.8,type:"pattern",pattern:{style:["verticalLines","horizontalLines"],width:5,height:6}},markers:{size:5,hover:{size:9}},title:{text:"Network Monitoring",style:{fontWeight:500}},tooltip:{intersect:!0,shared:!1},theme:{palette:"palette1"},xaxis:{type:"datetime"},yaxis:{title:{text:"Bytes Received"}},colors:chartBarColors=getChartColorsArray("area-missing-null-value")};(chart=new ApexCharts(document.querySelector("#area-missing-null-value"),options)).render();

document.addEventListener("DOMContentLoaded",function(){var l=new bootstrap.Modal(document.getElementById("event-modal"),{keyboard:!1});document.getElementById("event-modal");var t=document.getElementById("modal-title"),n=document.getElementById("form-event"),d=null,i=null,r=document.getElementsByClassName("needs-validation"),d=null,i=null,e=new Date,a=e.getDate(),s=e.getMonth(),o=e.getFullYear();new FullCalendar.Draggable(document.getElementById("external-events"),{itemSelector:".external-event",eventData:function(e){return{title:e.innerText,start:new Date,className:e.getAttribute("data-class")}}});var c=[{title:"All Day Event",start:new Date(o,s,1),className:"bg-primary"},{title:"Long Event",start:new Date(o,s,a-5),end:new Date(o,s,a-2),className:"bg-warning"},{id:999,title:"Repeating Event",start:new Date(o,s,a-3,16,0),allDay:!1,className:"bg-info"},{id:999,title:"Repeating Event",start:new Date(o,s,a+4,16,0),allDay:!1,className:"bg-primary"},{title:"Meeting",start:new Date(o,s,a,10,30),allDay:!1,className:"bg-success"},{title:"Lunch",start:new Date(o,s,a,12,0),end:new Date(o,s,a,14,0),allDay:!1,className:"bg-danger"},{title:"Birthday Party",start:new Date(o,s,a+1,19,0),end:new Date(o,s,a+1,22,30),allDay:!1,className:"bg-success"},{title:"Click for Google",start:new Date(o,s,28),end:new Date(o,s,29),url:"http://google.com/",className:"bg-dark"}],m=(document.getElementById("external-events"),document.getElementById("calendar"));function u(e){l.show(),n.classList.remove("was-validated"),n.reset(),d=null,t.innerText="Add Event",i=e}function v(){return 768<=window.innerWidth&&window.innerWidth<1200?"timeGridWeek":window.innerWidth<=768?"listMonth":"dayGridMonth"}var g=new FullCalendar.Calendar(m,{timeZone:"local",editable:!0,droppable:!0,selectable:!0,initialView:v(),themeSystem:"bootstrap",headerToolbar:{left:"prev,next today",center:"title",right:"dayGridMonth,timeGridWeek,timeGridDay,listMonth"},windowResize:function(e){var t=v();g.changeView(t)},eventDidMount:function(e){var t;"done"===e.event.extendedProps.status&&(e.el.style.backgroundColor="red",(t=e.el.getElementsByClassName("fc-event-dot")[0])&&(t.style.backgroundColor="white"))},eventClick:function(e){l.show(),n.reset(),document.getElementById("event-title").value[0]="",d=e.event,document.getElementById("event-title").value=d.title,document.getElementById("event-category").value=d.classNames[0],i=null,t.innerText="Edit Event",i=null},dateClick:function(e){u(e)},events:c});g.render(),n.addEventListener("submit",function(e){e.preventDefault();var t,n=document.getElementById("event-title").value,a=document.getElementById("event-category").value;!1===r[0].checkValidity()?r[0].classList.add("was-validated"):(d?(d.setProp("title",n),d.setProp("classNames",[a])):(t={title:n,start:i.date,allDay:i.allDay,className:a},g.addEvent(t)),l.hide())}),document.getElementById("btn-delete-event").addEventListener("click",function(e){d&&(d.remove(),(d=null).hide())}),document.getElementById("btn-new-event").addEventListener("click",function(e){u({date:new Date,allDay:!0})})});

function getChartColorsArray(e) {
    if (null !== document.getElementById(e)) {
        var r = document.getElementById(e).getAttribute("data-colors");
        return (r = JSON.parse(r)).map(function(e) {
            var r = e.replace(" ", "");
            if (-1 === r.indexOf(",")) {
                var t = getComputedStyle(document.documentElement).getPropertyValue(r);
                return t || r
            }
            var a = e.split(",");
            return 2 != a.length ? r : "rgba(" + getComputedStyle(document.documentElement).getPropertyValue(a[0]) + "," + a[1] + ")"
        })
    }
}
var chartBarColors = getChartColorsArray("mini-1"),
    options = {
        series: [{
            data: [2, 36, 22, 30, 12, 38]
        }],
        chart: {
            type: "line",
            width: 130,
            height: 55,
            sparkline: {
                enabled: !0
            }
        },
        colors: chartBarColors,
        stroke: {
            curve: "smooth",
            width: 2.5
        },
        tooltip: {
            fixed: {
                enabled: !1
            },
            x: {
                show: !1
            },
            y: {
                title: {
                    formatter: function(e) {
                        return ""
                    }
                }
            },
            marker: {
                show: !1
            }
        }
    },
    chart = new ApexCharts(document.querySelector("#mini-1"), options);
chart.render();
options = {
    chart: {
        height: 159,
        type: "area",
        toolbar: {
            show: !1
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        curve: "smooth",
        width: 2.5
    },
    series: [{
        name: "Previous",
        data: [55, 36, 61, 40, 58]
    }],
    colors: chartBarColors = getChartColorsArray("chart-area"),
    legend: {
        show: !1
    },
    fill: {
        type: "gradient",
        gradient: {
            shadeIntensity: 1,
            inverseColors: !1,
            opacityFrom: .45,
            opacityTo: .05,
            stops: [20, 100, 100, 100]
        }
    },
    yaxis: {
        show: !1
    },
    xaxis: {
        categories: ["Jan", "Feb", "Mar", "Apr", "May"]
    }
};
(chart = new ApexCharts(document.querySelector("#chart-area"), options)).render();
options = {
    chart: {
        height: 410,
        type: "bar",
        toolbar: {
            show: !1
        }
    },
    plotOptions: {
        bar: {
            borderRadius: 3,
            horizontal: !1,
            columnWidth: "64%",
            endingShape: "rounded"
        }
    },
    dataLabels: {
        enabled: !1
    },
    stroke: {
        show: !0,
        width: 2,
        colors: ["transparent"]
    },
    series: [{
        name: "Net Profit",
        data: [95, 40, 73, 60, 51, 37, 30]
    }, {
        name: "Revenue",
        data: [75, 26, 53, 44, 37, 26, 23]
    }],
    colors: chartBarColors = getChartColorsArray("column_chart"),
    xaxis: {
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July"]
    },
    grid: {
        borderColor: "#f1f1f1"
    },
    fill: {
        opacity: 1
    },
    legend: {
        show: !1
    },
    tooltip: {
        y: {
            formatter: function(e) {
                return "$ " + e + " thousands"
            }
        }
    }
};
(chart = new ApexCharts(document.querySelector("#column_chart"), options)).render();
options = {
    chart: {
        height: 287,
        type: "donut"
    },
    plotOptions: {
        pie: {
            donut: {
                size: "75%"
            }
        }
    },
    dataLabels: {
        enabled: !1
    },
    series: [60, 15, 8],
    labels: ["Completed", "Processing", "Cancel"],
    colors: chartBarColors = getChartColorsArray("chart-donut"),
    legend: {
        show: !1
    }
};
(chart = new ApexCharts(document.querySelector("#chart-donut"), options)).render();
var sparklineoptions1 = {
        series: [{
            data: [25, 66, 41, 89, 63, 25, 44, 12, 36, 9, 54, 84]
        }],
        chart: {
            type: "area",
            width: 120,
            height: 40,
            sparkline: {
                enabled: !0
            }
        },
        fill: {
            type: "gradient",
            gradient: {
                shadeIntensity: 1,
                inverseColors: !1,
                opacityFrom: .45,
                opacityTo: .05,
                stops: [20, 100, 100, 100]
            }
        },
        stroke: {
            curve: "smooth",
            width: 2
        },
        colors: chartBarColors = getChartColorsArray("chart-sparkline1"),
        tooltip: {
            fixed: {
                enabled: !1
            },
            x: {
                show: !1
            },
            y: {
                title: {
                    formatter: function(e) {
                        return ""
                    }
                }
            },
            marker: {
                show: !1
            }
        }
    },
    sparklinechart1 = new ApexCharts(document.querySelector("#chart-sparkline1"), sparklineoptions1);
sparklinechart1.render();
sparklineoptions1 = {
    series: [{
        data: [50, 15, 35, 62, 23, 56, 44, 12, 36, 9, 54, 23]
    }],
    chart: {
        type: "area",
        width: 120,
        height: 40,
        sparkline: {
            enabled: !0
        }
    },
    fill: {
        type: "gradient",
        gradient: {
            shadeIntensity: 1,
            inverseColors: !1,
            opacityFrom: .45,
            opacityTo: .05,
            stops: [20, 100, 100, 100]
        }
    },
    stroke: {
        curve: "smooth",
        width: 2
    },
    colors: chartBarColors = getChartColorsArray("chart-sparkline2"),
    tooltip: {
        fixed: {
            enabled: !1
        },
        x: {
            show: !1
        },
        y: {
            title: {
                formatter: function(e) {
                    return ""
                }
            }
        },
        marker: {
            show: !1
        }
    }
};
(sparklinechart1 = new ApexCharts(document.querySelector("#chart-sparkline2"), sparklineoptions1)).render();
sparklineoptions1 = {
    series: [{
        data: [25, 35, 35, 89, 63, 25, 44, 12, 36, 9, 54, 25]
    }],
    chart: {
        type: "area",
        width: 120,
        height: 40,
        sparkline: {
            enabled: !0
        }
    },
    fill: {
        type: "gradient",
        gradient: {
            shadeIntensity: 1,
            inverseColors: !1,
            opacityFrom: .45,
            opacityTo: .05,
            stops: [20, 100, 100, 100]
        }
    },
    stroke: {
        curve: "smooth",
        width: 2
    },
    colors: chartBarColors = getChartColorsArray("chart-sparkline3"),
    tooltip: {
        fixed: {
            enabled: !1
        },
        x: {
            show: !1
        },
        y: {
            title: {
                formatter: function(e) {
                    return ""
                }
            }
        },
        marker: {
            show: !1
        }
    }
};
(sparklinechart1 = new ApexCharts(document.querySelector("#chart-sparkline3"), sparklineoptions1)).render();
sparklineoptions1 = {
    series: [{
        data: [50, 15, 35, 34, 23, 56, 65, 41, 36, 41, 32, 25]
    }],
    chart: {
        type: "area",
        width: 120,
        height: 40,
        sparkline: {
            enabled: !0
        }
    },
    fill: {
        type: "gradient",
        gradient: {
            shadeIntensity: 1,
            inverseColors: !1,
            opacityFrom: .45,
            opacityTo: .05,
            stops: [20, 100, 100, 100]
        }
    },
    stroke: {
        curve: "smooth",
        width: 2
    },
    colors: chartBarColors = getChartColorsArray("chart-sparkline4"),
    tooltip: {
        fixed: {
            enabled: !1
        },
        x: {
            show: !1
        },
        y: {
            title: {
                formatter: function(e) {
                    return ""
                }
            }
        },
        marker: {
            show: !1
        }
    }
};
(sparklinechart1 = new ApexCharts(document.querySelector("#chart-sparkline4"), sparklineoptions1)).render();
sparklineoptions1 = {
    series: [{
        data: [45, 53, 24, 89, 63, 60, 36, 50, 36, 32, 54, 63]
    }],
    chart: {
        type: "area",
        width: 120,
        height: 40,
        sparkline: {
            enabled: !0
        }
    },
    fill: {
        type: "gradient",
        gradient: {
            shadeIntensity: 1,
            inverseColors: !1,
            opacityFrom: .45,
            opacityTo: .05,
            stops: [20, 100, 100, 100]
        }
    },
    stroke: {
        curve: "smooth",
        width: 2
    },
    colors: chartBarColors = getChartColorsArray("chart-sparkline5"),
    tooltip: {
        fixed: {
            enabled: !1
        },
        x: {
            show: !1
        },
        y: {
            title: {
                formatter: function(e) {
                    return ""
                }
            }
        },
        marker: {
            show: !1
        }
    }
};
(sparklinechart1 = new ApexCharts(document.querySelector("#chart-sparkline5"), sparklineoptions1)).render();
options = {
    series: [{
        data: [1040, 1320, 1560, 1280, 1480]
    }],
    chart: {
        type: "bar",
        height: 234,
        toolbar: {
            show: !1
        }
    },
    labels: ["Canada", "Russia", "Brazil", "United States", "Egypt"],
    colors: ["#776acf"],
    plotOptions: {
        bar: {
            borderRadius: 3,
            horizontal: !0
        }
    },
    dataLabels: {
        enabled: !1
    },
    xaxis: {
        categories: ["Canada", "Russia", "Brazil", "US", "Egypt"]
    }
};
(chart = new ApexCharts(document.querySelector("#sales-countries"), options)).render();
var map = new jsVectorMap({
        map: "world_merc",
        selector: "#world-map-markers",
        zoomOnScroll: !1,
        zoomButtons: !1,
        opacity: 1,
        regionStyle: {
            initial: {
                fill: "#f0f2f3"
            }
        },
        markerStyle: {
            initial: {
                fill: "#3cbf87"
            },
            selected: {
                fill: "#3cbf87"
            }
        },
        markers: [{
            name: "Canada",
            coords: [56.1304, -106.3468]
        }, {
            name: "Brazil",
            coords: [-14.235, -51.9253]
        }, {
            name: "Egypt",
            coords: [26.8206, 30.8025]
        }, {
            name: "Russia",
            coords: [61, 105]
        }, {
            name: "United States",
            coords: [37.0902, -95.7129]
        }],
        lines: [{
            from: "Canada",
            to: "Egypt"
        }, {
            from: "Russia",
            to: "Egypt"
        }, {
            from: "Brazil",
            to: "Egypt"
        }, {
            from: "United States",
            to: "Egypt"
        }],
        lineStyle: {
            animation: !0,
            strokeDasharray: "6 3 6"
        }
    }),
    swiper = new Swiper(".swiper-container", {
        spaceBetween: 10,
        pagination: {
            el: ".swiper-pagination",
            clickable: !0
        },
        navigation: {
            nextEl: ".swiper-button-next",
            prevEl: ".swiper-button-prev"
        },
        breakpoints: {
            576: {
                slidesPerView: 1,
                spaceBetween: 30
            },
            768: {
                slidesPerView: 2,
                spaceBetween: 30
            },
            1500: {
                slidesPerView: 2,
                spaceBetween: 30
            }
        }
    });

var lightbox=GLightbox({selector:".image-popup",title:!1}),lightboxDesc=GLightbox({selector:".image-popup-desc"}),lightboxvideo=GLightbox({selector:".image-popup-video-map",title:!1});


document.getElementById("alert").addEventListener("click",function(){alertify.alert("Alert Title","Alert Message!",function(){alertify.success("Ok")})}),document.getElementById("alert-confirm").addEventListener("click",function(){alertify.confirm("This is a confirm dialog.",function(){alertify.success("Ok")},function(){alertify.error("Cancel")})}),document.getElementById("alert-prompt").addEventListener("click",function(){alertify.prompt("This is a prompt dialog.","Default value",function(e,t){alertify.success("Ok: "+t)},function(){alertify.error("Cancel")})}),document.getElementById("alert-success").addEventListener("click",function(){alertify.success("Success message")}),document.getElementById("alert-error").addEventListener("click",function(){alertify.error("Error message")}),document.getElementById("alert-warning").addEventListener("click",function(){alertify.warning("Warning message")}),document.getElementById("alert-message").addEventListener("click",function(){alertify.message("Normal message")});


var slider=document.getElementById("slider");noUiSlider.create(slider,{start:[20,80],connect:!0,range:{min:0,max:100}});var resultElement=document.getElementById("result"),sliders=document.getElementsByClassName("sliders"),colors=[0,0,0];[].slice.call(sliders).forEach(function(t,n){noUiSlider.create(t,{start:127,connect:[!0,!1],orientation:"vertical",range:{min:0,max:255},format:wNumb({decimals:0})}),t.noUiSlider.on("update",function(){colors[n]=t.noUiSlider.get();var e="rgb("+colors.join(",")+")";resultElement.style.background=e,resultElement.style.color=e})});for(var select=document.getElementById("input-select"),i=-20;i<=40;i++){var option=document.createElement("option");option.text=i,option.value=i,select.appendChild(option)}var html5Slider=document.getElementById("html5");noUiSlider.create(html5Slider,{start:[10,30],connect:!0,range:{min:-20,max:40}});var inputNumber=document.getElementById("input-number");html5Slider.noUiSlider.on("update",function(e,t){var n=e[t];t?inputNumber.value=n:select.value=Math.round(n)}),select.addEventListener("change",function(){html5Slider.noUiSlider.set([this.value,null])}),inputNumber.addEventListener("change",function(){html5Slider.noUiSlider.set([null,this.value])});var nonLinearSlider=document.getElementById("nonlinear");noUiSlider.create(nonLinearSlider,{connect:!0,behaviour:"tap",start:[500,4e3],range:{min:[0],"10%":[500,500],"50%":[4e3,1e3],max:[1e4]}});var nodes=[document.getElementById("lower-value"),document.getElementById("upper-value")];nonLinearSlider.noUiSlider.on("update",function(e,t,n,l,i){nodes[t].innerHTML=e[t]+", "+i[t].toFixed(2)+"%"});var lockedState=!1,lockedSlider=!1,lockedValues=[60,80],slider1=document.getElementById("slider1"),slider2=document.getElementById("slider2"),lockButton=document.getElementById("lockbutton"),slider1Value=document.getElementById("slider1-span"),slider2Value=document.getElementById("slider2-span");function crossUpdate(e,t){var n;lockedState&&(e-=lockedValues[(n=slider1===t?0:1)?0:1]-lockedValues[n],t.noUiSlider.set(e))}function setLockedValues(){lockedValues=[Number(slider1.noUiSlider.get()),Number(slider2.noUiSlider.get())]}lockButton.addEventListener("click",function(){lockedState=!lockedState,this.textContent=lockedState?"unlock":"lock"}),noUiSlider.create(slider1,{start:60,animate:!1,range:{min:50,max:100}}),noUiSlider.create(slider2,{start:80,animate:!1,range:{min:50,max:100}}),slider1.noUiSlider.on("update",function(e,t){slider1Value.innerHTML=e[t]}),slider2.noUiSlider.on("update",function(e,t){slider2Value.innerHTML=e[t]}),slider1.noUiSlider.on("change",setLockedValues),slider2.noUiSlider.on("change",setLockedValues),slider1.noUiSlider.on("slide",function(e,t){crossUpdate(e[t],slider2)}),slider2.noUiSlider.on("slide",function(e,t){crossUpdate(e[t],slider1)});var hidingTooltipSlider=document.getElementById("slider-hide");noUiSlider.create(hidingTooltipSlider,{range:{min:0,max:100},start:[20,80],tooltips:!0});slider=document.getElementById("slider-color");noUiSlider.create(slider,{start:[4e3,8e3,12e3,16e3],connect:[!1,!0,!0,!0,!0],range:{min:[2e3],max:[2e4]}});for(var connect=slider.querySelectorAll(".noUi-connect"),classes=["c-1-color","c-2-color","c-3-color","c-4-color","c-5-color"],i=0;i<connect.length;i++)connect[i].classList.add(classes[i]);var toggleSlider=document.getElementById("slider-toggle");noUiSlider.create(toggleSlider,{orientation:"vertical",start:0,range:{min:[0,1],max:1},format:wNumb({decimals:0})}),toggleSlider.noUiSlider.on("update",function(e,t){"1"===e[t]?toggleSlider.classList.add("off"):toggleSlider.classList.remove("off")});var softSlider=document.getElementById("soft");noUiSlider.create(softSlider,{start:50,range:{min:0,max:100},pips:{mode:"values",values:[20,80],density:4}}),softSlider.noUiSlider.on("change",function(e,t){e[t]<20?softSlider.noUiSlider.set(20):80<e[t]&&softSlider.noUiSlider.set(80)});


var basicRating=raterJs({starSize:22,rating:3,element:document.querySelector("#basic-rater"),rateCallback:function(e,t){this.setRating(e),t()}}),starRatingStep=raterJs({starSize:22,step:.5,element:document.querySelector("#rater-step"),rateCallback:function(e,t){this.setRating(e),t()}}),messageDataService={rate:function(e){return{then:function(e){setTimeout(function(){e(5*Math.random())},1e3)}}}},starRatingmessage=raterJs({isBusyText:"Rating in progress. Please wait...",starSize:22,element:document.querySelector("#rater-message"),rateCallback:function(e,t){starRatingmessage.setRating(e),messageDataService.rate().then(function(e){starRatingmessage.setRating(e),t()})}}),starRatingunlimited=raterJs({max:16,readOnly:!0,rating:4.4,element:document.querySelector("#rater-unlimitedstar")}),starRatinghover=raterJs({starSize:22,element:document.querySelector("#rater-onhover"),rateCallback:function(e,t){this.setRating(e),t()},onHover:function(e,t){document.querySelector(".ratingnum").textContent=e},onLeave:function(e,t){document.querySelector(".ratingnum").textContent=t}}),starRatingreset=raterJs({starSize:22,element:document.querySelector("#raterreset"),rateCallback:function(e,t){this.setRating(e),t()}});document.querySelector("#raterreset-button").addEventListener("click",function(){starRatingreset.clear(),console.log(starRatingreset.getRating())},!1);

var swiper=new Swiper(".default-swiper",{slidesPerView:1,centeredSlides:!1,loop:!0,autoplay:{delay:3e3,disableOnInteraction:!1}}),swiper=new Swiper(".navigation-swiper",{slidesPerView:1,spaceBetween:40,centeredSlides:!1,loop:!0,pagination:".swiper-pagination",paginationClickable:!0,navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},autoplay:{delay:3e3,disableOnInteraction:!1}}),swiper=new Swiper(".pagination-swiper",{slidesPerView:1,spaceBetween:40,centeredSlides:!1,loop:!0,pagination:{el:".swiper-pagination",clickable:!0},autoplay:{delay:3e3,disableOnInteraction:!1}}),swiper=new Swiper(".keyboard-control",{loop:!0,keyboard:{enabled:!0},pagination:{el:".swiper-pagination",clickable:!0}}),swiper=new Swiper(".progress-swiper",{slidesPerView:1,spaceBetween:40,centeredSlides:!1,loop:!1,pagination:{el:".swiper-pagination",type:"progressbar"},navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"}}),swiper=new Swiper(".effectfade-swiper",{slidesPerView:1,effect:"flip",grabCursor:!0,centeredSlides:!1,loop:!0,pagination:{el:".swiper-pagination",clickable:!0},navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},autoplay:{delay:3e3,disableOnInteraction:!1}}),swiper=new Swiper(".responsive-swiper",{slidesPerView:1,spaceBetween:10,loop:!0,autoplay:{delay:3e3,disableOnInteraction:!1},navigation:{nextEl:".swiper-button-next",prevEl:".swiper-button-prev"},pagination:{el:".swiper-pagination",clickable:!0},breakpoints:{640:{slidesPerView:2,spaceBetween:10},768:{slidesPerView:3,spaceBetween:15},1024:{slidesPerView:4,spaceBetween:20}}});

function getChartColorsArray(t){if(console.log(t),null!==document.getElementById(t)){var e=document.getElementById(t).getAttribute("data-colors");return(e=JSON.parse(e)).map(function(t){var e=t.replace(" ","");if(-1===e.indexOf(",")){var a=getComputedStyle(document.documentElement).getPropertyValue(e);return a||e}var r=t.split(",");return 2!=r.length?e:"rgba("+getComputedStyle(document.documentElement).getPropertyValue(r[0])+","+r[1]+")"})}}var options={chart:{height:350,type:"bar",toolbar:{show:!1}},plotOptions:{bar:{horizontal:!0}},dataLabels:{enabled:!1},series:[{data:[380,430,450,475,550,584,780,1100,1220,1365]}],colors:chartBarColors=getChartColorsArray("bar_chart"),grid:{borderColor:"#f1f1f1"},xaxis:{categories:["South Korea","Canada","United Kingdom","Netherlands","Italy","France","Japan","United States","China","Germany"]}},chart=new ApexCharts(document.querySelector("#bar_chart"),options);chart.render();options={series:[{data:[400,430,448,470,540,580,690,1100,1200,1380]}],chart:{type:"bar",height:350,toolbar:{show:!1}},plotOptions:{bar:{barHeight:"100%",distributed:!0,horizontal:!0,dataLabels:{position:"bottom"}}},colors:chartBarColors=getChartColorsArray("custom_datalabels_bar"),dataLabels:{enabled:!0,textAnchor:"start",style:{colors:["#fff"]},formatter:function(t,e){return e.w.globals.labels[e.dataPointIndex]+":  "+t},offsetX:0,dropShadow:{enabled:!1}},stroke:{width:1,colors:["#fff"]},xaxis:{categories:["South Korea","Canada","United Kingdom","Netherlands","Italy","France","Japan","United States","China","India"]},yaxis:{labels:{show:!1}},title:{text:"Custom DataLabels",align:"center",floating:!0,style:{fontWeight:600}},subtitle:{text:"Category Names as DataLabels inside bars",align:"center"},tooltip:{theme:"dark",x:{show:!1},y:{title:{formatter:function(){return""}}}}};(chart=new ApexCharts(document.querySelector("#custom_datalabels_bar"),options)).render();options={series:[{name:"Marine Sprite",data:[44,55,41,37,22,43,21]},{name:"Striking Calf",data:[53,32,33,52,13,43,32]},{name:"Tank Picture",data:[12,17,11,9,15,11,20]},{name:"Bucket Slope",data:[9,7,5,8,6,9,4]},{name:"Reborn Kid",data:[25,12,19,32,25,24,10]}],chart:{type:"bar",height:350,stacked:!0,toolbar:{show:!1}},plotOptions:{bar:{horizontal:!0}},stroke:{width:1,colors:["#fff"]},title:{text:"Fiction Books Sales",style:{fontWeight:600}},xaxis:{categories:[2008,2009,2010,2011,2012,2013,2014],labels:{formatter:function(t){return t+"K"}}},yaxis:{title:{text:void 0}},tooltip:{y:{formatter:function(t){return t+"K"}}},fill:{opacity:1},legend:{position:"top",horizontalAlign:"left",offsetX:40},colors:chartBarColors=getChartColorsArray("stacked_bar")};(chart=new ApexCharts(document.querySelector("#stacked_bar"),options)).render();options={series:[{name:"Marine Sprite",data:[44,55,41,37,22,43,21]},{name:"Striking Calf",data:[53,32,33,52,13,43,32]},{name:"Tank Picture",data:[12,17,11,9,15,11,20]},{name:"Bucket Slope",data:[9,7,5,8,6,9,4]},{name:"Reborn Kid",data:[25,12,19,32,25,24,10]}],chart:{type:"bar",height:350,stacked:!0,stackType:"100%",toolbar:{show:!1}},plotOptions:{bar:{horizontal:!0}},stroke:{width:1,colors:["#fff"]},title:{text:"100% Stacked Bar",style:{fontWeight:600}},xaxis:{categories:[2008,2009,2010,2011,2012,2013,2014]},tooltip:{y:{formatter:function(t){return t+"K"}}},fill:{opacity:1},legend:{position:"top",horizontalAlign:"left",offsetX:40},colors:chartBarColors=getChartColorsArray("stacked_bar_100")};(chart=new ApexCharts(document.querySelector("#stacked_bar_100"),options)).render();options={series:[{name:"Males",data:[.4,.65,.76,.88,1.5,2.1,2.9,3.8,3.9,4.2,4,4.3,4.1,4.2,4.5,3.9,3.5,3]},{name:"Females",data:[-.8,-1.05,-1.06,-1.18,-1.4,-2.2,-2.85,-3.7,-3.96,-4.22,-4.3,-4.4,-4.1,-4,-4.1,-3.4,-3.1,-2.8]}],chart:{type:"bar",height:360,stacked:!0,toolbar:{show:!1}},colors:chartBarColors=getChartColorsArray("negative_bars"),plotOptions:{bar:{horizontal:!0,barHeight:"80%"}},dataLabels:{enabled:!1},stroke:{width:1,colors:["#fff"]},grid:{xaxis:{lines:{show:!1}}},yaxis:{min:-5,max:5,title:{text:"Age",style:{fontWeight:600}}},tooltip:{shared:!1,x:{formatter:function(t){return t}},y:{formatter:function(t){return Math.abs(t)+"%"}}},title:{text:"Mauritius population pyramid 2011",style:{fontWeight:600}},xaxis:{categories:["85+","80-84","75-79","70-74","65-69","60-64","55-59","50-54","45-49","40-44","35-39","30-34","25-29","20-24","15-19","10-14","5-9","0-4"],title:{text:"Percent"},labels:{formatter:function(t){return Math.abs(Math.round(t))+"%"}}}};(chart=new ApexCharts(document.querySelector("#negative_bars"),options)).render();options={series:[{name:"Actual",data:[{x:"2011",y:12,goals:[{name:"Expected",value:14,strokeWidth:5,strokeColor:"#564ab1"}]},{x:"2012",y:44,goals:[{name:"Expected",value:54,strokeWidth:5,strokeColor:"#564ab1"}]},{x:"2013",y:54,goals:[{name:"Expected",value:52,strokeWidth:5,strokeColor:"#564ab1"}]},{x:"2014",y:66,goals:[{name:"Expected",value:65,strokeWidth:5,strokeColor:"#564ab1"}]},{x:"2015",y:81,goals:[{name:"Expected",value:66,strokeWidth:5,strokeColor:"#564ab1"}]},{x:"2016",y:67,goals:[{name:"Expected",value:70,strokeWidth:5,strokeColor:"#564ab1"}]}]}],chart:{height:350,type:"bar",toolbar:{show:!1}},plotOptions:{bar:{horizontal:!0}},colors:chartBarColors=getChartColorsArray("bar_markers"),dataLabels:{formatter:function(t,e){e.w.config.series[e.seriesIndex].data[e.dataPointIndex].goals;return t}},legend:{show:!0,showForSingleSeries:!0,customLegendItems:["Actual","Expected"],markers:{fillColors:["#00E396","#775DD0"]}}};(chart=new ApexCharts(document.querySelector("#bar_markers"),options)).render();var chartBarColors=getChartColorsArray("reversed_bars"),options={series:[{data:[400,430,448,470,540,580,690]}],chart:{type:"bar",height:350,toolbar:{show:!1}},annotations:{xaxis:[{x:500,borderColor:"#038edc",label:{borderColor:"#038edc",style:{color:"#fff",background:"#038edc"},text:"X annotation"}}],yaxis:[{y:"July",y2:"September",label:{text:"Y annotation"}}]},plotOptions:{bar:{horizontal:!0}},dataLabels:{enabled:!0},xaxis:{categories:["June","July","August","September","October","November","December"]},grid:{xaxis:{lines:{show:!0}}},yaxis:{reversed:!0,axisTicks:{show:!0}}};(chart=new ApexCharts(document.querySelector("#reversed_bars"),options)).render();options={series:[{name:"Marine Sprite",data:[44,55,41,37,22,43,21]},{name:"Striking Calf",data:[53,32,33,52,13,43,32]},{name:"Tank Picture",data:[12,17,11,9,15,11,20]},{name:"Bucket Slope",data:[9,7,5,8,6,9,4]}],chart:{type:"bar",height:350,stacked:!0,dropShadow:{enabled:!0,blur:1,opacity:.25},toolbar:{show:!1}},plotOptions:{bar:{horizontal:!0,barHeight:"60%"}},dataLabels:{enabled:!1},stroke:{width:2},title:{text:"Compare Sales Strategy",style:{fontWeight:600}},xaxis:{categories:[2008,2009,2010,2011,2012,2013,2014]},yaxis:{title:{text:void 0}},tooltip:{shared:!1,y:{formatter:function(t){return t+"K"}}},fill:{type:"pattern",opacity:1,pattern:{style:["circles","slantedLines","verticalLines","horizontalLines"]}},states:{hover:{filter:"none"}},legend:{position:"right",offsetY:40},colors:chartBarColors=getChartColorsArray("patterned_bars")};(chart=new ApexCharts(document.querySelector("#patterned_bars"),options)).render();options={series:[{data:[44,55,41,64,22,43,21]},{data:[53,32,33,52,13,44,32]}],chart:{type:"bar",height:410,toolbar:{show:!1}},plotOptions:{bar:{horizontal:!0,dataLabels:{position:"top"}}},dataLabels:{enabled:!0,offsetX:-6,style:{fontSize:"12px",colors:["#fff"]}},stroke:{show:!0,width:1,colors:["#fff"]},tooltip:{shared:!0,intersect:!1},xaxis:{categories:[2001,2002,2003,2004,2005,2006,2007]},colors:chartBarColors=getChartColorsArray("grouped_bar")};(chart=new ApexCharts(document.querySelector("#grouped_bar"),options)).render();chartBarColors=getChartColorsArray("bar_images"),options={series:[{name:"coins",data:[2,4,3,4,3,5,5,6.5,6,5,4,5,8,7,7,8,8,10,9,9,12,12,11,12,13,14,16,14,15,17,19,21]}],chart:{type:"bar",height:410,animations:{enabled:!1},toolbar:{show:!1}},plotOptions:{bar:{horizontal:!0,barHeight:"100%"}},dataLabels:{enabled:!1},stroke:{colors:["#fff"],width:.2},labels:Array.apply(null,{length:39}).map(function(t,e){return e+1}),yaxis:{axisBorder:{show:!1},axisTicks:{show:!1},labels:{show:!1},title:{text:"Weight"}},grid:{position:"back"},title:{text:"Paths filled by clipped image",align:"right",offsetY:30,style:{fontWeight:600}},fill:{type:"image",opacity:.87,image:{src:["../../assets/images/profile-bg.jpg"],width:466,height:406}}};(chart=new ApexCharts(document.querySelector("#bar_images"),options)).render();


function getChartColorsArray(t){if(console.log(t),null!==document.getElementById(t)){var e=document.getElementById(t).getAttribute("data-colors");return(e=JSON.parse(e)).map(function(t){var e=t.replace(" ","");if(-1===e.indexOf(",")){var o=getComputedStyle(document.documentElement).getPropertyValue(e);return o||e}var r=t.split(",");return 2!=r.length?e:"rgba("+getComputedStyle(document.documentElement).getPropertyValue(r[0])+","+r[1]+")"})}}var options={series:[{type:"boxPlot",data:[{x:"Jan 2015",y:[54,66,69,75,88]},{x:"Jan 2016",y:[43,65,69,76,81]},{x:"Jan 2017",y:[31,39,45,51,59]},{x:"Jan 2018",y:[39,46,55,65,71]},{x:"Jan 2019",y:[29,31,35,39,44]},{x:"Jan 2020",y:[41,49,58,61,67]},{x:"Jan 2021",y:[54,59,66,71,88]}]}],chart:{type:"boxPlot",height:350,toolbar:{show:!1}},title:{text:"Basic BoxPlot Chart",align:"left",style:{fontWeight:500}},plotOptions:{boxPlot:{colors:{upper:(chartBarColors=getChartColorsArray("basic_box"))[0],lower:chartBarColors[1]}}}},chart=new ApexCharts(document.querySelector("#basic_box"),options);chart.render();var chartBarColors=getChartColorsArray("box_plot"),options={series:[{name:"Box",type:"boxPlot",data:[{x:new Date("2017-01-01").getTime(),y:[54,66,69,75,88]},{x:new Date("2018-01-01").getTime(),y:[43,65,69,76,81]},{x:new Date("2019-01-01").getTime(),y:[31,39,45,51,59]},{x:new Date("2020-01-01").getTime(),y:[39,46,55,65,71]},{x:new Date("2021-01-01").getTime(),y:[29,31,35,39,44]}]},{name:"Outliers",type:"scatter",data:[{x:new Date("2017-01-01").getTime(),y:32},{x:new Date("2018-01-01").getTime(),y:25},{x:new Date("2019-01-01").getTime(),y:64},{x:new Date("2020-01-01").getTime(),y:27},{x:new Date("2020-01-01").getTime(),y:78},{x:new Date("2021-01-01").getTime(),y:15}]}],chart:{type:"boxPlot",height:350,toolbar:{show:!1}},colors:chartBarColors,title:{text:"BoxPlot - Scatter Chart",align:"left",style:{fontWeight:500}},xaxis:{type:"datetime",tooltip:{formatter:function(t){return new Date(t).getFullYear()}}},plotOptions:{boxPlot:{colors:{upper:"#f1734f",lower:"#564ab1"}}},tooltip:{shared:!1,intersect:!0}};(chart=new ApexCharts(document.querySelector("#box_plot"),options)).render();