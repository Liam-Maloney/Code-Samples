-module(functions).
-compile(export_all). 

head([H|_]) -> H.

second([_,X|_]) -> X.

%%Particular implementation will run based on whether the parameters match
%%So this is more like a conditional statement rather than a function signature

same(X,X) -> true;
same(_,_) -> false.

%%So pattern matching will occur on YMD, HMinS first, and if all of this passes
%%then the first implementation of valid_time will execute.

valid_time({Date = {Y,M,D}, Time = {H,Min,S}}) ->
	
	io:format("The Date tuple (~p) says today is: ~p/~p/~p,~n",[Date,Y,M,D]),
	io:format("The time tuple (~p) indicates: ~p:~p:~p.~n", [Time,H,Min,S]);

valid_time(_) ->
	
	io:format("Stop feeding me wrong data!~n").
