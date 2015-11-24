-module(recursion_practice).
-export([count_list/1, factorial/1, reverses_list/1]).

-author("Liam Maloney").
-date("11/11/2015").

-compile(export_all).

%%interface function
count_list(MyList) ->
    count_list(MyList, 0).

count_list([], Acc) -> Acc; 
count_list([_|Tl], Acc) -> 
    count_list(Tl, Acc + 1).

%%public interface
factorial(N) -> factorial(N,1).

factorial(0,Acc) -> Acc;
factorial(N,Acc) when N > 0 -> 
    factorial(N - 1, N * Acc).

%%public interface
duplicate_rec(0, _) -> [];
duplicate_rec(Z, Term) when Z > 0 -> [Term | duplicate_rec(Z - 1, Term)]. 

%%public interface
duplicate_tail(Z, Term) -> duplicate_tail(Z, Term, []). 
duplicate_tail(0, _, List) -> List;
duplicate_tail(Z, Term, List) when Z > 0 -> 
    duplicate_tail(Z - 1, Term, [Term | List]).

%%interface
reverses_list(List_To_Be_Reversed) ->
    reverses_list([], List_To_Be_Reversed).

reverses_list(Reversing_List, [Orig_Head | Orig_Tail]) ->
    reverses_list([Orig_Head | Reversing_List], Orig_Tail);
reverses_list(Reversed_List, []) ->
    Reversed_List.

%%interface function
zip(Zip, Zap) ->
    zip(Zip, Zap, []).

zip([X | TlX ], [Y | TlY ], Tuple_Builder) ->
    zip(TlX, TlY, [{X, Y} | Tuple_Builder]);
zip([], [], Zipped) ->
    Zipped.

quicksort([]) -> [];
quicksort([Pivot|Rest]) ->
{Smaller, Larger} = partition(Pivot,Rest,[],[]),
quicksort(Smaller) ++ [Pivot] ++ quicksort(Larger).

partition(_,[], Smaller, Larger) -> {Smaller, Larger};
partition(Pivot, [H|T], Smaller, Larger) ->
if H =< Pivot -> partition(Pivot, T, [H|Smaller], Larger);
H >  Pivot -> partition(Pivot, T, Smaller, [H|Larger])
end.
