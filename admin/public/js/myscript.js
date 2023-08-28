
$(document).ready(function(){
    $(document).on('click','.category_delete',function(event){
        event.preventDefault();
        let status = confirm ("Are you sure to delete?");

        if(status)
        {
            let id = $(this).parent().attr('id') 
            $.ajax({
                method:'post',
                url:'deleteCategory.php',
                data:{id:id},
                success:function(response){
                        alert(response);
                        location.href = "category.php";
                },
                error:function(error){
                    
                }
            })
        }
    })

    $(document).on('click','.user_delete',function(event){
        event.preventDefault();
        let status = confirm ("Are you sure to delete?");

        if(status)
        {
            let id = $(this).parent().attr('id') 
            $.ajax({
                method:'post',
                url:'deleteUser.php',
                data:{id:id},
                success:function(response){
                        alert(response);
                        location.href = "userList.php";
                },
                error:function(error){
                    alert(error);
                }
            })
        }
    })

    $(document).on('click','.code_delete',function(event){
        event.preventDefault();
        let status = confirm ("Are you sure to delete?");

        if(status)
        {
            let id = $(this).parent().attr('id') 
            $.ajax({
                method:'post',
                url:'deleteCode.php',
                data:{id:id},
                success:function(response){
                        alert(response);
                        location.href = "code.php";
                },
                error:function(error){
                    alert(error);
                }
            })
        }
    })


        $(document).on('click','.product_delete',function(event){
            event.preventDefault();
            let status = confirm ("Are you sure to delete?");

            if(status)
            {
                let id = $(this).parent().attr('id') 
                $.ajax({
                    method:'post',
                    url:'deleteProduct.php',
                    data:{id:id},
                    success:function(response){
                        if(response === 'success')
                        {
                            alert("Successfully deleted!")
                            location.href = "product.php"
                        }
                        else{
                            alert(response)
                        }
                    },
                    error:function(error){
                    
                    }
                })
            }
        })

        $(document).on('click','.group_delete',function(event){
            event.preventDefault();
            let status = confirm ("Are you sure to delete?");
            console.log(status);

            if(status)
            {
                let id = $(this).parent().attr('id') 
                $.ajax({
                    method:'post',
                    url:'deleteGroup.php',
                    data:{id:id},
                    success:function(response){
                        if(response == 'success')
                        {
                            alert("Successfully deleted!")
                            location.href = "group.php"
                        }
                        else{
                            alert(response)
                        }
                    },
                    error:function(error){
                    
                    }
                })
            }
        })

        $(document).on('click','.city_delete',function(event){
            event.preventDefault();
            let status = confirm ("Are you sure to delete?");

            if(status)
            {
                let id = $(this).parent().attr('id') 
                $.ajax({
                    method:'post',
                    url:'deleteCity.php',
                    data:{id:id},
                    success:function(response){
                            alert(response);
                            location.href = "city.php";
                    },
                    error:function(error){
                        alert(error)
                    }
                })
            }
        })

        $(document).on('click','.township_delete',function(event){
            event.preventDefault();
            let status = confirm ("Are you sure to delete?");

            if(status)
            {
                let id = $(this).parent().attr('id') 
                $.ajax({
                    method:'post',
                    url:'deleteTownship.php',
                    data:{id:id},
                    success:function(response){
                            alert(response);
                            location.href = "township.php";
                    },
                    error:function(error){
                        alert(error)
                    }
                })
            }
        })

        $(document).on('click','.delivery_delete',function(event){
            event.preventDefault();
            let status = confirm ("Are you sure to delete?");

            if(status)
            {
                let id = $(this).parent().attr('id') 
                $.ajax({
                    method:'post',
                    url:'deleteDelivery.php',
                    data:{id:id},
                    success:function(response){
                            alert(response);
                            location.href = "delivery.php";
                    },
                    error:function(error){
                        alert(error)
                    }
                })
            }
        })

        $(document).on('click','.report',function(event){
            event.preventDefault();
            const reportDataDiv = document.getElementById('reportData');
            var month = $('#month').val();
            // console.log(month);
            var year = $('#year').val();
            $.ajax({
                url : 'add_report.php',
                method: 'post',
                data:{month: month,year : year},
                success:function(response){
                    reportDataDiv.innerHTML=response;
                },
                error: function(message){

                }
            })
        })
        $(document).on('click','.report_line',function(event){
            event.preventDefault();
            // console.log(month);
            var year = $('#year').val();
             console.log(year);
            $.ajax({
                url : 'report_line.php',
                method: 'post',
                data:{year:year},
                success: function(response)
                {
                    let report = JSON.parse(response);
                    // console.log(report);
                    let data = [];
                    let month = [];
                    let monthName = ['January', 'February', 'March', 'April', 'May', 'June',
                    'July', 'August', 'September', 'October', 'November', 'December'];
                    let label;
                    for(let index = 0; index < report.length; index++)
                    {
                        data[index] = report[index].sellingPrice;
                        month[index] = report[index].month;
                        label = month.map(month => monthName[month-1])
                    }
                     console.log(label)
                    saleChart = new Chart(document.getElementById("chartjs-dashboard-bar"), {
                        type: "bar",
                        data: {
                            labels: label,
                            datasets: [{
                                label: label,
                                backgroundColor: window.theme.primary,
                                borderColor: window.theme.primary,
                                hoverBackgroundColor: window.theme.primary,
                                hoverBorderColor: window.theme.primary,
                                data: data,
                                barPercentage: .75,
                                categoryPercentage: .5
                            }]
                        },
                        // options: {
                        //     maintainAspectRatio: false,
                        //     legend: {
                        //         display: false
                        //     },
                        //     scales: {
                        //         yAxes: [{
                        //             gridLines: {
                        //                 display: false
                        //             },
                        //             stacked: false,
                        //             ticks: {
                        //                 stepSize: 20000
                        //             }
                        //         }],
                        //         xAxes: [{
                        //             stacked: false,
                        //             gridLines: {
                        //                 color: "transparent"
                        //             }
                        //         }]
                        //     }
                        // }
                        options: {
                            scales: {
                                y: {
                                    beginAtZero: true,
                                    suggestedMax:100000
                                }
                            }
                        }
                    });

                },
                error: function(message)
                {
        
                }
            })
        })

        $(document).on('click','.stockDetail_delete',function(event){
            event.preventDefault();
            let status = confirm ("Are you sure to delete?");
            console.log(status);
    
            if(status)
            {
                let id = $(this).parent().attr('id') 
                $.ajax({
                    method:'post',
                    url:'deleteStockDetail.php',
                    data:{id:id},
                    success:function(response){
                        if(response == 'success')
                        {
                            alert("Successfully deleted!")
                            location.href = "stock_details.php"
                        }
                        else{
                            alert(response)
                        }
                    },
                    error:function(error){
                    
                    }
                })
            }
        })

        $(document).on('click','.submit_btn',function(event){
            event.preventDefault();
            const reportDataDiv = document.getElementById('reportData');
            var start = $('#start_date').val();
            // console.log(start);
            var end = $('#end_date').val();
            $.ajax({
                url : 'add_stock.php',
                method: 'post',
                data:{start: start,end : end},
                success:function(response){
                    reportDataDiv.innerHTML=response;
                },
                error: function(message){
    
                }
            })
        })


        $.ajax({
            url : 'report_pie.php',
            method: 'post',
            success: function(response)
            {
                let category = JSON.parse(response);
                console.log(category);
                let total = [];
                let data = [];
    
                for(let index = 0; index < category.length; index++)
                {
                    total[index] = category[index].total;
                    data[index] = category[index].catname;
                }
                new Chart(document.getElementById("chartjs-dashboard-pie"), {
                    type: "pie",
                    data: {
                        labels: data,
                        datasets: [{
                            data: total,
                            backgroundColor: [
                                window.theme.primary,
                                window.theme.warning,
                                window.theme.danger
                            ],
                            borderWidth: 5
                        }]
                    },
                    options: {
                        responsive: !window.MSInputMethodContext,
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        cutoutPercentage: 75
                    }
                });
    
            },
            error: function(message)
            {
    
            }
        })
     
        $('#mytable').DataTable();
       

    
    $('#catTable').DataTable();
})