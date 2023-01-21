$(document).ready(function() { 
         

            // var colors_roulette = [];
                  var colors_roulette = [];
            
            var names = [];
            $.post("/engine/obr/profile.php", { action: "roulette_get_item" }).done(function(data) {
                        
                         json = jQuery.parseJSON(data);
                         
                        for (var i = 0; i < json.length; i++) {
                            
                            colors_roulette.push(json[i].i_images);
                             names.push(json[i].i_name);
                            
                        }
                        var colvoprizov = names.length;
                         for (var i = 0; i < 15; i++) {

                             var idwin = Math.floor((Math.random() * colvoprizov) + 1);
                             $(".roulette-container").append("<div class='rwin' style='background: url(" + colors_roulette[idwin - 1] + ");'><div class='prize-name'>" + names[idwin - 1] + "</div></div>");

                        }
                        $("#go-roullet").click(function() {
               $.post("/engine/obr/profile.php", { action: "roulette_check_balance" }).done(function(data) 
               {
                    if(data == "success")
                    {
                     
                      $(".roulette-container").html("");
                      $(".roulette-container").css("left", "30px");
                      for (var i = 0; i < 67; i++) {
                          var idwin = Math.floor((Math.random() * colvoprizov) + 1);
                          $(".roulette-container").append("<div class='rwin' style='background: url(" + colors_roulette[idwin - 1] + ");'><div class='prize-name'>" + names[idwin - 1] + "</div></div></div>");
                      }

                      var id_ = 0;
                

                      $.post("/engine/obr/profile.php", { action: "roulette_generate",value:names.length  }).done(function(data) {

                          //alert(data);
                        id_ = parseInt(data);
                        $(".roulette-container").append("<div class='rwin' style='background: url(" + colors_roulette[id_ - 1] + ");'><div class='prize-name'>" + names[id_ - 1] + "</div></div>");
                      

                      /* в конец добавляем рандом приз */
                      for(var i = 0; i < 2; i++)
                      {
                        var ids_ = Math.floor((Math.random() * colvoprizov) + 1);
                        $(".roulette-container").append("<div class='rwin' style='background: url(" + colors_roulette[ids_ - 1] + ");'><div class='prize-name'>" + names[ids_ - 1] + "</div></div>");
                       
                      }

                      $("button").attr('disabled', true);

                      var speed = 5; // любая 

                     
                      $(".roulette-container").animate({
                          left: "-=10010"
                      }, speed * 1000, function() {
                           
                          swal("Перемога!","Вам випало: " + names[id_ - 1] + ".\n\nЗабрати приз ви можете  перейдіть в особистий кабінет->інвентар","success");
                          end();
                      });

                      function end() {




                          $("button").attr('disabled', false);

                          
                      } 
                    });
                      $.post("/engine/obr/profile.php", { action: "roulette_get_balance" }).done(function(data) {
                        
                         $("#balance").html(data);
                      });
                  }
                  else if(data == "cash") swal("Ой!","У вас не вистачає донату!","warning");
                  
                  else if(data == "online") swal("Інформація!","Щоб крутити рулетку, ви повинні вийти із гри!","info");

                  else if(data == "error") $(".logs").html('<META HTTP-EQUIV="REFRESH" CONTENT="0;/profile/exit">');
                  else $(".logs").html(data);
               });
                


              });
              });
            
        //     var colors_roulette = [

        //       "/public/main/img/roulette/car402.png",//Buffalo
        //       "/public/main/img/roulette/money.png", //Деньги
        //       "/public/main/img/roulette/car411.png",//Infernus
        //       "/public/main/img/roulette/time.png", //EXP
        //       "/public/main/img/roulette/car415.png",//Cheetah

        //       "/public/main/img/roulette/car422.png",//Bobcat
        //       "/public/main/img/roulette/donate.png",//Донат

        //       "/public/main/img/roulette/car424.png",//BF Injection

        //       "/public/main/img/roulette/car506.png",//Super GT

        //       "/public/main/img/roulette/car541.png",//Bullet

        //       "/public/main/img/roulette/skin5.png",//Барри Торн
      
        //       "/public/main/img/roulette/skin46.png",//Хмури
   
        //       "/public/main/img/roulette/skin294.png",//Вузи
      
        //       "/public/main/img/roulette/skin299.png",//Клауд
  
        //       "/public/main/img/roulette/skin297.png"//Мэдд Дог
        //     ];
        //     var names = [
        //       "Buffalo",//1 
        //       "Деньги",//2
        //       "Infernus",//3
        //       "EXP", //4
        //       "Cheetah",//5
      
        //       "Bobcat",//7
        //       "Донат",//8
            
        //       "BF Injection",//10
            
        //       "Super GT",//12
             
        //       "Bullet",//14
          
        //       "Барри Торн",//16
              
        //       "Хмури",//18
          
        //       "Вузи",//20
            
        //       "Клауд",//22
            
        //       "Мэдд Дог"//24
        //     ];
        //     // var names = [
        //     //   "Buffalo",//1 
        //     //   "Деньги",//2
        //     //   "Infernus",//3
        //     //   "EXP", //4
        //     //   "Cheetah",//5
        //     //   "Деньги", //6
        //     //   "Bobcat",//7
        //     //   "Донат",//8
        //     //   "Деньги", //9
        //     //   "BF Injection",//10
        //     //   "EXP",//11
        //     //   "Super GT",//12
        //     //   "Деньги",//13
        //     //   "Bullet",//14
        //     //   "Деньги",//15
        //     //   "Барри Торн",//16
        //     //   "Деньги",//17
        //     //   "Хмури",//18
        //     //   "Донат",//19
        //     //   "Вузи",//20
        //     //   "Деньги",//21
        //     //   "Клауд",//22
        //     //   "EXP",//23
        //     //   "Мэдд Дог"//24
        //     // ];
            
            // var colvoprizov = names.length;
            //  for (var i = 0; i < 67; i++) {

            //      var idwin = Math.floor((Math.random() * colvoprizov) + 1);
            //      $(".roulette-container").append("<div class='rwin' style='background: url(" + colors_roulette[idwin - 1] + ");'><div class='prize-name'>" + names[idwin - 1] + "</div></div>");

            // }
            
        //     $("#go-roullet").click(function() {
        //        $.post("/engine/obr/profile.php", { action: "roulette_check_balance" }).done(function(data) 
        //        {
        //             if(data == "success")
        //             {
                     
        //               $(".roulette-container").html("");
        //               $(".roulette-container").css("left", "30px");
        //               for (var i = 0; i < 67; i++) {
        //                   var idwin = Math.floor((Math.random() * colvoprizov) + 1);
        //                   $(".roulette-container").append("<div class='rwin' style='background: url(" + colors_roulette[idwin - 1] + ");'><div class='prize-name'>" + names[idwin - 1] + "</div></div></div>");
        //               }

        //               var id_ = 0;
                

        //               $.post("/engine/obr/profile.php", { action: "roulette_generate",value:names.length  }).done(function(data) {


        //                 id_ = parseInt(data);
        //                 $(".roulette-container").append("<div class='rwin' style='background: url(" + colors_roulette[id_ - 1] + ");'><div class='prize-name'>" + names[id_ - 1] + "</div></div>");
                      

        //               /* в конец добавляем рандом приз */
        //               for(var i = 0; i < 2; i++)
        //               {
        //                 var ids_ = Math.floor((Math.random() * colvoprizov) + 1);
        //                 $(".roulette-container").append("<div class='rwin' style='background: url(" + colors_roulette[ids_ - 1] + ");'><div class='prize-name'>" + names[ids_ - 1] + "</div></div>");
                       
        //               }

        //               $("button").attr('disabled', true);

        //               var speed = 5; // любая 

                     
        //               $(".roulette-container").animate({
        //                   left: "-=10010"
        //               }, speed * 1000, function() {
                           
        //                   swal("Победа!","Вам выпало: " + names[id_ - 1] + ".\n\nЗабрать приз вы можете в игре при помощи команды: /roulette_priz\n\nИнформация: Донат начисляется автоматически!","success");
        //                   end();
        //               });

        //               function end() {




        //                   $("button").attr('disabled', false);

                          
        //               } 
        //             });
        //               $.post("/engine/obr/profile.php", { action: "roulette_get_balance" }).done(function(data) {
                        
        //                  $("#balance").html(data);
        //               });
        //           }
        //           else if(data == "cash") swal("Упс!","У вас не хватает доната!","warning");
                  
        //           else if(data == "online") swal("Информация!","Чтобы крутить рулетку, вы должны выйти из игры!","info");

        //           else if(data == "error") $(".logs").html('<META HTTP-EQUIV="REFRESH" CONTENT="0;/profile/exit">');
        //           else $(".logs").html(data);
        //        });
                


        //       });
        });