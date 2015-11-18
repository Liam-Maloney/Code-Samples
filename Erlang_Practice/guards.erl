-module(guards).

-compile(export_all).

oldEnoughToDrive(X) when X >= 16 -> true;
oldEnoughToDrive(_) -> false. 
