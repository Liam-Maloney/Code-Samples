-module(test_io).
-compile(export_all).

sample_input() ->
    Name = io:get_line("Please enter your name: "),
    io:format("Hello ~s", [Name]).
