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
		Node* nodeArcPointsTo;
	};

	struct Node
	{
		T dataContainedAtNode;
		std::list<Arc> arcs;	
	};

	//Will act as a list of pointers to the graph nodes.
	std::list<Node> graphNodesList;

	//---------------- END GRAPH STRUCTURES------------------------

	//--------------------OPERATIONS-------------------------------

public:

	bool isEmpty()
	{
		return graphNodesList.empty();
	};

	void addNode(T newNodeData)
	{
		Node newNode;
		newNode.dataContainedAtNode = newNodeData;
		graphNodesList.push_back(newNode);
	}

	void addEdge(T nodeToAddEdge, T newEdgeLinkTo)
	{
		std::list<Node>::iterator sourceOfEdge = graphNodesList.begin();
		while ((sourceOfEdge->dataContainedAtNode != nodeToAddEdge) & sourceOfEdge != graphNodesList.end())
		{
			sourceOfEdge++;
		}

		std::list<Node>::iterator destinationOfEdge = graphNodesList.begin();
		while ((destinationOfEdge->dataContainedAtNode != newEdgeLinkTo) & destinationOfEdge != graphNodesList.end())
		{
			destinationOfEdge++;
		}

		Arc newEdge;
		//1. Dereference iterator to get the node we want to point the edge to
		//2. Now return the address of that node and assign it to nodeArcPointsTo
		newEdge.nodeArcPointsTo = &(*destinationOfEdge);
		sourceOfEdge->arcs.push_back(newEdge);
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
	SG.addNode("Mary");
	SG.addNode("James");

	SG.addEdge("Tom", "Liam");
	SG.addEdge("Tom", "Mary");
	SG.addEdge("Mary", "Tom");
	SG.addEdge("James", "Liam");

	system("pause");
}