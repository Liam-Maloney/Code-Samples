-module(useless).
-export([add/2, greeting/0, greetAndAddTwo/1]).

add(FirstNumberToAdd, SecondNumberToAdd) ->
	FirstNumberToAdd + SecondNumberToAdd.

greeting() ->
	io:format("Hello world ~n").

greetAndAddTwo(NumberToAddTwoToo) ->
	greeting(),
	add(NumberToAddTwoToo, 2).
