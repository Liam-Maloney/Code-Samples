#include "stdafx.h"
#include <list>
#include <string>
#include <iostream>
#include <algorithm>

template <typename T> class Graph
{
	//------------------- GRAPH STRUCTURES------------------------

	struct Node;

	struct Arc
	{
		T nodeArcPointsTo;
	};

	//Represents a Node in the Graph
	struct Node
	{
		T dataContainedAtNode;
		std::list<Arc> arcs;	//A list of arcs from this node
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
		newNode.dataContainedAtNode = newNodeData;
		newNode.id = IDGen++;
		graphNodesList.push_back(newNode);
	}

	void addEdge(T nodeToAddEdge, T linkTo)
	{
		//search for the element to add the edge to
		//stores reference to the item we want to find
		std::list<Node>::iterator find = graphNodesList.begin();
		//find the vertex to insert the edge to 
		while ((find->dataContainedAtNode != nodeToAddEdge) & find != graphNodesList.end())
		{
			find++;
		}
		//now establish the link and add it to the arcs list
		Arc newEdge;
		newEdge.nodeArcPointsTo = linkTo;
		find->arcs.push_back(newEdge);
	}

	void removeEdge(T nodeToRemoveEdgeFrom, T edgeToRemove)
	{
		std::list<Node>::iterator findsNode = graphNodesList.begin();
		//find the vertex to remove the edge from 
		while ((findsNode->dataContainedAtNode != nodeToRemoveEdgeFrom) & findsNode != graphNodesList.end())
		{
			findsNode++;
		}

		//now get a reference to the arc to remove
		std::list<Arc>::iterator findsArc = findsNode->arcs.begin();
		while (findsArc->nodeArcPointsTo != edgeToRemove)
		{
			findsArc++;
		}
		findsNode->arcs.erase(findsArc);
	}

	void removeNode(T nodeToRemove)
	{
		std::list<Node>::iterator findsNodeToDelete = graphNodesList.begin();
		//find the vertex to remove the edge from 
		while ((findsNodeToDelete->dataContainedAtNode != nodeToRemove) & findsNodeToDelete != graphNodesList.end())
		{
			findsNodeToDelete++;
		}
		graphNodesList.erase(findsNodeToDelete);
	}

	bool isConnectedTo(T connectionFrom, T connectionTo)
	{
		std::list<Node>::iterator connectionFromNode = graphNodesList.begin();
		while ((connectionFromNode->dataContainedAtNode != connectionFrom) & connectionFromNode != graphNodesList.end())
		{
			connectionFromNode++;
		}

		bool isConnected = false;
		std::list<Arc>::iterator findsArc = connectionFromNode->arcs.begin();
		std::list<Arc>::iterator arcsEnd = connectionFromNode->arcs.end();
		arcsEnd--;

		while ((findsArc->nodeArcPointsTo != connectionTo) && (findsArc != arcsEnd))
		{
			findsArc++;
		}

		if (findsArc->nodeArcPointsTo == connectionTo)
		{
			isConnected = true;
		}

		return isConnected;
	}

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

	std::string from;
	std::string to;

	from = "Liam";
	to = "Tom";
	if (SG.isConnectedTo(from, to))
	{
		std::cout << from << " and " << to << " are connected" << std::endl;
	}
	else
	{
		std::cout << from << " and " << to << " are NOT connected" << std::endl;
	}

	from = "Liam";
	to = "Mary";
	if (SG.isConnectedTo(from, to))
	{
		std::cout << from << " and " << to << " are connected" << std::endl;
	}
	else
	{
		std::cout << from << " and " << to << " are NOT connected" << std::endl;
	}

	system("pause");
}