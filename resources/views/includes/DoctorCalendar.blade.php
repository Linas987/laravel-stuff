
<style>

.date:hover{
    background-color:#500EA0;
    }

.day{
    width:60px;
    height:25px;
    color:white;
    float:left;
    padding:5px;
    text-align:center;
    font:bold 12px arial;
    border-bottom:1px solid #999999;
    border-right:1px solid #999999;
    background-color:#6040D0;
    }

     .container_calendar{
    width: 425px;
    height:400px;
    margin: auto;
    background-color:#f7f7f7;
    border-radius:20px;
    border:2px solid #999999;
    }
     .date{
    width:60px;
    height:60px;
    text-align: center;
    float:left;
    border-bottom:1px solid #999999;
    border-right:1px solid #999999;
    background-color:#ffffff;
    }
    .ocupied{
      width:60px;
      height:60px;
      text-align: center;
      float:left;
      border-bottom:1px solid #999999;
      border-right:1px solid #999999;
      background-color:Red;
    }
    .booked{
        width:60px;
        height:60px;
        text-align: center;
        float:left;
        border-bottom:1px solid #999999;
        border-right:1px solid #999999;
        background-color:Blue;
    }
    .freeday{
        width:60px;
        height:60px;
        text-align: center;
        float:left;
        border-bottom:1px solid #999999;
        border-right:1px solid #999999;
        background-color:Gray;
    }

</style>

<?php
    if(!function_exists('get_buttons')){
        function get_buttons($dayscounter,$doc_id,$doctors,$id=NULL)
        {
        $dateselected=date("Y-m",strtotime(strval($_SESSION['select_month'])." month")) ."-". "$dayscounter";
        //echo $user_id;
        //$sql = DB::select("SELECT Times FROM doctor_user WHERE doctor_id='$doc_id' AND date_register='$dateselected'");

        //check if the database allready has that time on that day of that doctor
        $occup1=false;
        $occup2=false;
        $occup3=false;
        $occup4=false;
        $occup5=false;
        $occup6=false;
        $occup7=false;
        $occup8=false;

        foreach($doctors->where('id','=',$doc_id)->first()->users as $row)
        {
            if($row->pivot->date_register==$dateselected)
            {
                //echo $row->pivot->date_register;
                if($row->pivot->Times=='08:00:00'){$occup1=true;}
                if($row->pivot->Times=='09:00:00'){$occup2=true;}
                if($row->pivot->Times=='10:00:00'){$occup3=true;}
                if($row->pivot->Times=='11:00:00'){$occup4=true;}
                if($row->pivot->Times=='13:00:00'){$occup5=true;}
                if($row->pivot->Times=='14:00:00'){$occup6=true;}
                if($row->pivot->Times=='15:00:00'){$occup7=true;}
                if($row->pivot->Times=='16:00:00'){$occup8=true;}
            }
        }

        if($id){
            ?><form method="POST" action="{{route('EditDate2',$id)}}">
            <input type="hidden" name="_method" value="PATCH"/><?php
        }else{
            ?><form method="POST" action="{{route('Date')}}"><?php
        }
        ?>
            @csrf
            <div class="dropdown">
                <button
                    class="mw-100 btn dropdown-toggle"
                    type="button"
                    id="dropdownMenu2"
                    data-bs-toggle="dropdown"
                    aria-expanded="false"
                >
                    <?php echo $dayscounter;?><br>Pick
                </button>
                <input type="hidden" name="dateselected" value='{{$dateselected}}' />
                <input type="hidden" name="doc_id" value='{{$doc_id}}' />
                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                    <?php //if yes than do not display that option
                    if(!$occup1) {echo  '<li><button class="dropdown-item" type="submit" name="timereg" value="08:00:00">08:00</button></li>';}
                    if(!$occup2) {echo  '<li><button class="dropdown-item" type="submit" name="timereg" value="09:00:00">09:00</button></li>';}
                    if(!$occup3) {echo  '<li><button class="dropdown-item" type="submit" name="timereg" value="10:00:00">10:00</button></li>';}
                    if(!$occup4) {echo  '<li><button class="dropdown-item" type="submit" name="timereg" value="11:00:00">11:00</button></li>';}
                    if(!$occup5) {echo  '<li><button class="dropdown-item" type="submit" name="timereg" value="13:00:00">13:00</button></li>';}
                    if(!$occup6) {echo  '<li><button class="dropdown-item" type="submit" name="timereg" value="14:00:00">14:00</button></li>';}
                    if(!$occup7) {echo  '<li><button class="dropdown-item" type="submit" name="timereg" value="15:00:00">15:00</button></li>';}
                    if(!$occup8) {echo  '<li><button class="dropdown-item" type="submit" name="timereg" value="16:00:00">16:00</button></li>';}
                    ?>
                </ul>
            </div>
        </form>
        <?php
        }
    }
    //dd($doctors);
  echo "<div align=center><h1>" . date("F Y",strtotime("first day of ".strval($_SESSION['select_month'])." month"))   . "<h1></div>";
        if (isset($doctors))if (isset($doc_id)){echo "<div align=center>". $doctors->where('id','=',$doc_id)->first()->name." ".$doctors->where('id','=',$doc_id)->first()->surname."</div>";}
?>

<div class=container_calendar>
    <div>
      <div class="day" style="border-top-left-radius:18px;">Sunday</div>
      <div class=day>Monday</div>
      <div class=day>Tuesday</div>
      <div class=day>Wednesday</div>
      <div class=day>Thursday</div>
      <div class=day>Friday</div>
      <div class="day" style="border-top-right-radius:18px;">Saturday</div>
      <div class="clear"></div>
    </div>
    {{--$doc_id--}}
    <?php
    //$numofdays=date("t");//numbers of days in the current month
    $numofdays=cal_days_in_month(CAL_GREGORIAN, date("m",strtotime("first day of ".strval($_SESSION['select_month'])." month")), date("Y",strtotime("first day of ".strval($_SESSION['select_month'])." month")));
    $first=date("Y-m",strtotime("first day of ".strval($_SESSION['select_month'])." month")) ."-". "1";//get the current year and month, join it with firstday of the month
    $day=strtotime($first);//get the timestamp value of $first
    //echo $day;
    $firstday= date("w",$day);//get the numeric representation of the firstday in the month
    $hasdaystarted=false; //have we reached the first day of the month
    $dayscounter=0;
    $numofdays=$numofdays+$firstday;
    ?>

    <!--foreach($doctors as $doctor)
        {
          {{--$doctor->name--}}
        }-->
    <?php

    if (isset($doc_id)) {
        //dd($doctors[0]->users[0]->pivot->Times);
        ?> {{--$sql=$doctors[$doc_id-1]->users->count()--}}<?php
      //$sql = DB::select("SELECT date_register FROM doctor_user WHERE doctor_id=$doc_id");
      //echo $sql->num_rows;
       //echo $doctors[$doc_id-1]->users->count();
        $times=array();
    //echo $doctors[$doc_id-1]->users;
        //dd($doctors[0]);
        //dd($doctors->where('id','=',$doc_id)->first());
                //this part filters out obselete dates
                if ($doctors->where('id','=',$doc_id)->first()->users->count() > 0){
                    foreach ($doctors->where('id','=',$doc_id)->first()->users as $row )
                    {
                        $date = $row->pivot->date_register;
                        //echo $date;
                        $timestamp = date_parse_from_format('Y-m-d', $date)['day'];
                        //echo $timestamp."  ";
                        //echo date("m",strtotime(strval($_SESSION['select_month'])." month"));
                        if((date("Y",strtotime(strval($_SESSION['select_month'])." month"))==date_parse_from_format('Y-m-d',$date)['year'])and(date("m",strtotime(strval($_SESSION['select_month'])." month"))==date_parse_from_format('Y-m-d',$date)['month']))
                        {array_push($times, "$timestamp");}//this array will be used to color occupied days
                    }
                }

        $size = count($times);
               //dd($times);
        $now=date("Y-m-d");
        $now_time=strtotime($now);

        $userRegisteredDays_time=array();
        foreach($doctors->where('id','=',$doc_id)->first()->users->where('id','=',Auth::user()->id) as $row){
            //dd(date_parse_from_format('Y-m-d', $row->pivot->date_register)['day']);
            array_push($userRegisteredDays_time, strtotime($row->pivot->date_register));
        }

        //array of non-workDays
        $currYear=date("Y",strtotime(strval($_SESSION['select_month'])." month"));
        $nonWorkDay=[$currYear ."-01-01",$currYear ."-02-16",$currYear ."-03-11",$currYear ."-04-17",$currYear ."-04-18",$currYear ."-05-01",$currYear ."-06-24",$currYear ."-07-06",$currYear ."-08-15",$currYear ."-11-01",$currYear ."-11-02",$currYear ."-12-24",$currYear ."-12-25",$currYear ."-12-26".$currYear ."-12-31"];

        //the actual output of the days starts here

        for($I=0; $I<$numofdays; $I++){
            if($I==$firstday)//delays the output of days
                $hasdaystarted= true;
                if($hasdaystarted){
                    $dayscounter++;
                    if($dayscounter<10)
                        {$dayscounter=sprintf("%02d",$dayscounter);}

                    $dupes=false;

                    $thisday=date("Y-m",strtotime(strval($_SESSION['select_month'])." month")) ."-". "$dayscounter";
                    $thisday_time=strtotime($thisday);
                    //echo $thisday;
                    //echo $thisday.'<br>';
                    // sql for completely occupied days will be used for displaying fully filled up days
                    //$hours = DB::select("SELECT Times FROM doctor_user WHERE doctor_id=$doc_id AND date_register='$thisday'");
                        $hoursnumber=0;
                        foreach($doctors->where('id','=',$doc_id)->first()->users as $row)
                        {if($row->pivot->date_register==$thisday)
                            {
                                $hoursnumber++;
                            }
                        }

                    //echo $hoursnumber;
                    //$thisday_timefin= date("w",$thisday_time);

                    if(date('N', $thisday_time)>= 6|| in_array($thisday,$nonWorkDay))
                    {
                        echo "<div class=freeday>$dayscounter</div>";
                        $dupes=true;
                    }
                    else if($thisday_time<$now_time)
                    {
                        echo "<div class=ocupied>$dayscounter</div>";
                        $dupes=true;
                    }
                    else if(in_array($thisday_time,$userRegisteredDays_time))
                    {
                        echo "<div class=booked>$dayscounter</div>";
                        $dupes=true;
                    }

                    // for displaying fully filled up days if 4 instances has been found
                    for($J=0; $J<$size; $J++){
                        if(($times[$J]==$dayscounter)&&(!$dupes)&&($hoursnumber>=8))
                        {
                            echo "<div class='ocupied'>$dayscounter</div>";
                            $dupes=true;
                        }
                    }
                if(!$dupes){
                    ?>
                    <div class=date>
                        <?php
                        if(isset($id)) {
                            get_buttons($dayscounter, $doc_id, $doctors,$id);
                        }else{
                            get_buttons($dayscounter,$doc_id,$doctors);
                        }
                        ?>
                    </div>
                <?php
                }
        }
        else
            echo "<div class=date>  </div>";
        }
    }
    ?>
</div>
