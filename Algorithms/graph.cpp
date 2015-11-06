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
		bool visited = true;
		T dataContainedAtNode;
		std::list<Arc*> arcs;	//needs to be a list of pointers, 
								//as I will be using the address to delete particular Arcs
	};

	std::list<Node*> graphNodesList;

	//---------------- END GRAPH STRUCTURES------------------------

	//--------------------OPERATIONS-------------------------------

	void resetNodesDFSStatus()
	{
		std::list<Node*>::iterator traversesGraphNodes = graphNodesList.begin();
		for (std::list<Node*>::iterator traversesGraphNodes = graphNodesList.begin(); 
			traversesGraphNodes != graphNodesList.end(); traversesGraphNodes++)
		{
			(*traversesGraphNodes)->visited = false;
		}
	}

	Node* findNode(T findNodeWithThisData)
	{
		std::list<Node*>::iterator findsNode = graphNodesList.begin();
		while (((*findsNode)->dataContainedAtNode != findNodeWithThisData))
		{
			findsNode++;
		}
		return *findsNode;
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
		Node* newNode = new Node;
		newNode->dataContainedAtNode = newNodeData;
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

	void removeNode(T dataOfNodeToRemove)
	{
		Node* nodeToRemove = findNode(dataOfNodeToRemove);
		graphNodesList.remove(nodeToRemove);
		delete nodeToRemove;
	}

	bool isEdgeBetween(T connectionFrom, T connectionTo)
	{
		bool isConnected = false;
		Node* connectionFromNode = findNode(connectionFrom);
		Node* lookingForAConnectionToThis = findNode(connectionTo);
		std::list<Arc*>::iterator findsArc = connectionFromNode->arcs.begin();
		std::list<Arc*>::iterator delimitsEndOfSearch = connectionFromNode->arcs.end();
		delimitsEndOfSearch--;
		//Scans through the list of Arcs at the Source Node, and stops when it reaches the end or the mem address of 
		//the node we are testing to see if there is a connection to.
		while (((*findsArc)->nodeArcPointsTo != lookingForAConnectionToThis) && findsArc != delimitsEndOfSearch)
		{
			findsArc++;
		}
		if ((*findsArc)->nodeArcPointsTo == lookingForAConnectionToThis)
		{
			isConnected = true;
		}
		return isConnected;
	}

	void depthFirstSearch(T startDFSFromThisNode)
	{
		//first find the pointer to the node which has specified value
		//call DFSRun which will do the actual DFS
		//reset all of the colors to the unvisited value

		Node* startPointerForDFSRun = findNode(startDFSFromThisNode);
		DFSRun(startPointerForDFSRun);
		resetNodesDFSStatus();
	}

	void DFSRun(Node* currentNodeToTraverse)
	{
		//for loop using iterator on the node we start from, until we reach the end
		//of the arcs which branch from it.
			//mark this node as visited
			//if the node we point to has not been visited, then call DFS 
			//recursively.
		//return after, and mark this nodes color as finished processing
	}

	void breadthFirstSearch();

	//------------------END OPERATIONS-----------------------------
};

int main()
{
	DiGraph<int> intGraph;

	for (int i = 0; i < 8; i++)
	{
		intGraph.addNode(i);
	}


	intGraph.addArc(0, 1);
	intGraph.addArc(0, 3);
	intGraph.addArc(1, 2);
	intGraph.addArc(1, 6);
	intGraph.addArc(2, 4);
	intGraph.addArc(3, 7);
	intGraph.addArc(5, 1);
	intGraph.addArc(6, 2);
	intGraph.addArc(6, 7);
	intGraph.addArc(7, 5);
	intGraph.addArc(7, 6);

	/*
	SG.addNode("Tom");
	SG.addNode("Liam");
	SG.addNode("Mary");
	SG.addNode("James");
	SG.addNode("testRemoval");

	SG.addArc("Tom", "Liam");
	SG.addArc("Tom", "Mary");
	SG.addArc("Mary", "Tom");
	SG.addArc("James", "Mary");
	SG.addArc("James", "Liam");
	SG.addArc("James", "Tom");

	std::cout << SG.isEdgeBetween("James", "Liam") << std::endl;
	std::cout << SG.isEdgeBetween("James", "testRemoval") << std::endl;

	SG.removeNode("testRemoval");
	*/

	intGraph.depthFirstSearch(0);

	//expected output was:  0 1 2 4 6 7 5 3

	system("pause");
}