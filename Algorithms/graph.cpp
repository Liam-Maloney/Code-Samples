#include "stdafx.h"
#include <list>
#include <string>
#include <iostream>
#include <algorithm>

template <typename T> class Graph
{
	//------------------- GRAPH STRUCTURES------------------------

	//Represents Arcs between vertexes
	struct Arc
	{
		T goesTo;				//Identifier for element Arc goes to
		int weight;				//weight of connection (Not used for now)
		Arc* next;				//Pointer to next Arc from parents node
	};

	//Represents a Node in the Graph
	struct Node
	{
		T data;
		std::list<Arc> arcs;	//A list of arcs from this node
		int id;					//An identifier for this node (Not used for now, may be used
								//in future to differenciate duplicate nodes)
	};

	//Will act as a list of pointers to the graph nodes.
	std::list<Node> graphNodesList;
	int IDGen = 0;	//will be incremented every time a new node is added

	//---------------- END GRAPH STRUCTURES------------------------

	//--------------------OPERATIONS-------------------------------

public:

	bool isEmpty()
	{
		return graphNodesList.empty();
	};

	//Adds a new vertex to the graph
	void addNode(T newNodeData)
	{
		Node newNode;
		newNode.data = newNodeData;
		newNode.id = IDGen++;
		graphNodesList.push_back(newNode);
	}

	void addEdge(T nodeToAddEdge, T linkTo)
	{
		//search for the element to add the edge to
		//stores reference to the item we want to find
		std::list<Node>::iterator find = graphNodesList.begin();
		//find the vertex to insert the edge to 
		while ((find->data != nodeToAddEdge) & find != graphNodesList.end())
		{
			find++;
		}
		//now establish the link and add it to the arcs list
		Arc newEdge;
		newEdge.goesTo = linkTo;
		find->arcs.push_back(newEdge);
	}

	void removeEdge(T nodeToRemoveEdgeFrom, T edgeToRemove)
	{
		std::list<Node>::iterator findsNode = graphNodesList.begin();
		//find the vertex to remove the edge from 
		while ((findsNode->data != nodeToRemoveEdgeFrom) & findsNode != graphNodesList.end())
		{
			findsNode++;
		}

		//now get a reference to the arc to remove
		std::list<Arc>::iterator findsArc = findsNode->arcs.begin();
		while (findsArc->goesTo != edgeToRemove)
		{
			findsArc++;
		}
		findsNode->arcs.erase(findsArc);
	}

	void removeNode(T nodeToRemove)
	{
		std::list<Node>::iterator findsNodeToDelete = graphNodesList.begin();
		//find the vertex to remove the edge from 
		while ((findsNodeToDelete->data != nodeToRemove) & findsNodeToDelete != graphNodesList.end())
		{
			findsNodeToDelete++;
		}
		graphNodesList.erase(findsNodeToDelete);
	}

	bool areAdjacentNodes();

	void depthFirstSearch();

	void breadthFirstSearch();

	//------------------END OPERATIONS-----------------------------
};

int main()
{
	Graph<std::string> SG;

	SG.addNode("Tom");
	SG.addNode("Liam");
	SG.addNode("Gary");
	SG.addNode("Ciara");
	SG.addNode("Mary");
	SG.addEdge("Liam", "Tom");
	SG.addEdge("Liam", "Mary");
	SG.addEdge("Liam", "Gary");
	SG.removeEdge("Liam", "Mary");
	SG.removeNode("Gary");
	system("pause");
}