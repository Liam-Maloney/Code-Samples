#include "stdafx.h"
#include <list>
#include <string>

class Graph
{
	//------------------- GRAPH STRUCTURES------------------------

	//Represents Arcs between vertexes
	struct Arc
	{
		std::string goesTo;		//Identifier for element Arc goes to
		int weight;				//weight of connection
		Arc* next;				//Pointer to next Arc from parents node
	};

	//Represents a Node in the Graph
	struct Node
	{
		Node* next;				//Next node in graph
		std::list<Arc> arcs;	//A list of arcs from this node
		std::string id;			//An identifier for this node
	};

	//---------------- END GRAPH STRUCTURES------------------------
};

int main() {
	return 0;
}