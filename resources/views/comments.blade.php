                <div class="col-sm-16 comments-area">
                  <div class="main-title-outer pull-left">
                    <div class="main-title" style="float:{{$align}}">{{__('messages.comments')}}</div>
                  </div>


                  @foreach($post->comments as $comment)
                    <div class="opinion pull-{{$align}}">
                      <div class="media">
                        
                        <div class="media-body">
                          <div>
                            <h4 class="media-heading">
                            @if($comment->user_id)
                              {{$comment->user->name}}
                            @else
                              {{$comment->author}}
                            @endif
                            </h4>
                            <div class="time text-danger"><span class="ion-android-data icon"></span> {{$comment->created_at->format('Y-m-d h:i:s A')}}</div>
                            @if(Auth::user())
                            <a href="{{route('comment.destroy',$comment->id)}}" onclick="return confirm('هل أنت متأكد من المسح')" class="btn btn-danger btn-sm" title="مسح التعليق (مخالف)">x</a>
                            @endif
                            <div>
                            </div>

                          </div>
                            {{$comment->body}}
                        </div>
                      </div>
                    </div>
                    <div style="clear: both;">
                      
                    </div>
                  @endforeach
                </div>