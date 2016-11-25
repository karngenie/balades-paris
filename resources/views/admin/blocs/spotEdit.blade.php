						
    <div class="stepIcon">
        <span class="glyphicon {{$icon_content}}" aria-hidden="true"></span>
    </div>
    <div class="cardDetailDesc">
        {{ Form::hidden('spot_id[]', $spot_id,['class' => 'admSpotHiddId']) }}
        {{ Form::label('name_'.$spot_id, 'Nom du bloc :', ['class' => 'admSpotLblNameWalk awesome']) }}
        {{ Form::text('name[]',$spot_name,['id'=>'name_'.$spot_id ,  'temp_spot_id' => $temp_spot_id, 'class' => "admSpotNameWalk spotSelector"])}}     
        {{ Form::label("desc_".$spot_id, 'Description :', ['class' => 'admSpotLblDescWalk awesome']) }}
        {{ Form::textarea('desc[]',$desc,['id'=>'desc_'.$spot_id , 'class' => 'admSpotDescWalk editor']) }}
    </div>
