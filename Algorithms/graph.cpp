#include "stdafx.h"
#include <list>
#include <string>

template <typename T> class Graph
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
		T data;
		Node* next;				//Next node in graph
		std::list<Arc> arcs;	//A list of arcs from this node
		std::string id;			//An identifier for this node
	};

	//Will act as a list of pointers to the graph nodes.
	std::list<Node*> graphNodesList;

	//---------------- END GRAPH STRUCTURES------------------------

	//--------------------OPERATIONS-------------------------------

public:

	bool isEmpty();

	//Adds a new vertex to the graph
	void addNode(T newNodeData)
	{
		Node* newNode = new Node;
		newNode->data = newNodeData;
		graphNodesList.push_front(newNode);
	}

	void addEdge();

	void removeEdge();

	void removeNode();

	bool areAdjacentNodes();

	void depthFirstSearch();

	void breadthFirstSearch();

	//------------------END OPERATIONS-----------------------------
};