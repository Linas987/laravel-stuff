@extends('layouts.app')

@section('content')

    <div class="container content col-md-12">
        <div class="row">
            <div class="col-sm">
                <p style="font-weight: 700 !important;">This ir our currentelly registered users number</p>
                <p class="Big_text">{{ DB::table('users')->count() }}</p>
            </div>
            <div class="col-sm">
                <p style="font-weight: 700 !important;">Upcoming appointments</p>
                <!--form class="black_text" method="post" action="{{--route('Date')--}}"-->
                {{--@csrf--}}
                {{--@method('DELETE')--}}
                <form class="content black_text" method="get" action="{{route('WriteCard')}}">
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">name</th>
                            <th scope="col">surname</th>
                            <th scope="col">date register</th>
                            <th scope="col">Time</th>
                            <th scope="col">Patient ID</th>
                            <th scope="col">Edit</th>
                        </tr>
                        <thead>
                        <tbody>
                        <?php
                            //sort by Date_register
                            /*function sortByDate($a, $b) {
                                return $a['date_register'] > $b['date_register'];


                                                                echo '<tr>';
                                    print '<td>'.DB::table('users')->where('id',$D->user_id)->get()[0]->name.'</td>'.
                                    '<td>'.DB::table('users')->where('id',$D->user_id)->get()[0]->surname.'</td>'.
                                    '<td>'.$D->date_register.'</td>'.
                                    '<td>'.$D->Times.'</td>'.
                                    '<td>'.DB::table('users')->where('id',$D->user_id)->get()[0]->id.'</td>';
                                    echo '</tr>';
                                }
                            }*/
                            //array_multisort(array_column($data, 'date_register'),  SORT_ASC,
                            //array_column($data, 'Times'), SORT_ASC,
                            //$data);
                            //usort($data,'sortByDate');
                            foreach($appointment as $D)
                                {
                                    ?><input type="hidden" name="userID" value={{DB::table("users")->where("id",$D->user_id)->get()[0]->id}} /><?php
                                    echo '<tr>';
                                    print '<td>'.DB::table('users')->where('id',$D->user_id)->get()[0]->name.'</td>'.
                                    '<td>'.DB::table('users')->where('id',$D->user_id)->get()[0]->surname.'</td>'.
                                    '<td>'.$D->date_register.'</td>'.
                                    '<td>'.$D->Times.'</td>'.
                                    '<td>'.DB::table('users')->where('id',$D->user_id)->get()[0]->id.'</td>'.
                                    '<td>'?><button type="submit" class="btn btn-primary btn-lg my-1">Write card</button><?php '</td>';
                                    echo '</tr>';
                                }
                        ?>
                        </tbody>
                    </table>
                <span>
                    {{$appointment->links()}}
                </span>
                </form>
                <!--/form-->
            </div>
        </div>
    </div>
@endsection
