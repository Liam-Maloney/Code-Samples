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

	//--------------------OPERATIONS-------------------------------

public:

	bool isEmpty();
	void addNode();
	void addEdge();
	void removeEdge();
	void removeNode();
	bool areAdjacentNodes();
	void depthFirstSearch();
	void breadthFirstSearch();

	//------------------END OPERATIONS-----------------------------
};

int main() {
	return 0;
}