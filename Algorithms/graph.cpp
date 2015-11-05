#include "stdafx.h"
#include <list>
#include <string>
#include <iostream>
#include <algorithm>

template <typename T> class DiGraph
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
		std::list<Arc*> arcs;	//needs to be a list of pointers, 
								//as I will be using the address to delete particular Arcs
	};

	//Will act as a list of pointers to the graph nodes.
	std::list<Node> graphNodesList;

	//---------------- END GRAPH STRUCTURES------------------------

	//--------------------OPERATIONS-------------------------------

	Node* findNode(T findNodeWithThisData)
	{
		std::list<Node>::iterator findsNode = graphNodesList.begin();
		while ((findsNode->dataContainedAtNode != findNodeWithThisData) & findsNode != graphNodesList.end())
		{
			findsNode++;
		}
		return &(*findsNode);
	}

	Arc* findArc(Node* findArcFromHere, Node* findArcToHere)
	{
		std::list<Arc*>::iterator findsArc = findArcFromHere->arcs.begin();
		while ((*findsArc)->nodeArcPointsTo != findArcToHere)
		{
			findsArc++;
		}
		return *findsArc;
	}

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

	void addArc(T nodeToAddArc, T newArcLinkTo)
	{
		Node* sourceOfArc = findNode(nodeToAddArc);
		Node* destinationOfArc = findNode(newArcLinkTo);
		Arc* newArc = new Arc;
		newArc->nodeArcPointsTo = destinationOfArc;
		sourceOfArc->arcs.push_back(newArc);
	}

	void removeArc(T dataOfNodeToRemoveArcFrom, T dataOfNodeWhichArcGoesTo)
	{
		Node* nodeToRemoveArcFrom = findNode(dataOfNodeToRemoveArcFrom);
		Node* removeArcTo = findNode(dataOfNodeWhichArcGoesTo);
		Arc* arcToRemove = findArc(nodeToRemoveArcFrom, removeArcTo);
		nodeToRemoveArcFrom->arcs.remove(arcToRemove);
		delete arcToRemove;
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
	DiGraph<std::string> SG;

	SG.addNode("Tom");
	SG.addNode("Liam");
	SG.addNode("Mary");
	SG.addNode("James");

	SG.addArc("Tom", "Liam");
	SG.addArc("Tom", "Mary");
	SG.addArc("Mary", "Tom");
	SG.addArc("James", "Liam");

	SG.removeArc("Tom", "Liam");

	system("pause");
}