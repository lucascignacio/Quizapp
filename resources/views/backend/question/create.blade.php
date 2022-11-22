@extends('backend.layouts.master')

	@section('title','Create quiz')

	@section('content')

	<div class="span9">
     <div class="content">

     	@if(Session::has('message'))
     		<div class="alert alert-success">{{Session::get('message')}}</div>
     	@endif



         <form action="{{route('question.store')}}" method="POST">@csrf
			
            <div class="module">
                <div class="module-head">
                    <h3>Create Quiz</h3>
                </div>

                <div class="module-body">
                    <div class="control-group">
                    <label class="control-lable" for="name">Select Quiz</label>
                    <div class="controls"> 
                        <select name="quiz" class="span8">
                            @foreach(App\Models\Quiz::all() as $quiz)
                            <option value="{{$quiz->id}}">{{$quiz->name}}}</option>
                            @endforeach
                        </select>
                    </div>
                    @error('question')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror      

                    <div class="control-group">
                    <label class="control-lable" for="name">Question name</label>
                    <div class="controls"> 
                        <input type="text" name="question" class="span8 @error('question') border-red @enderror" placeholder="Question of a Quiz" value=""/>
                    </div>
                    @error('question')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                    <div class="control-group">
                    <label class="control-lable" for="options">Options</label>
                    <div class="controls"> 
                        @for($i=0;$i<4;$i++)
                        <input type="text" name="options[]" class="span7 @error('options') border-red @enderror" placeholder="options{{$i+1}}" require=""/>
                        
                        <input type="radio" name="correct_answer" value="{{$i}}">
                        <span>Is correct answer</span>
                        @endfor
                    </div>
                    @error('options')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                    @enderror

                <div class="control-group">
                    <div class="controls">
                        <button type="submit" class="btn btn-success">Submit</button>
                    </div>

                </div>


                </div>
            </div>
        </form>
    </div>
    </div>
                      
                    
@endsection