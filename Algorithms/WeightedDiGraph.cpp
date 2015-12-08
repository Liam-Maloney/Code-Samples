#include "stdafx.h"
#include <list>
#include <string>
#include <iostream>
#include <algorithm>
#include <queue>

/*
	Author:		Liam Maloney
	Date:		18th Nov 2015
	Purpose:	An implementation of a weighted directed graph.
*/

template <typename T> class WeightedDiGraph
{
	//------------------- GRAPH STRUCTURES------------------------

	struct Node;

	enum Color
	{
		FINISHED,
		PROCESSING,
		UNDISCOVERED
	};

	struct Arc
	{
		int weight = 0;
		Node* nodeArcPointsTo;
		Node* nodeArcPointsFrom;
	};

	struct Node
	{
		Color status = UNDISCOVERED;
		bool notVisitedYet = true;
		T dataContainedAtNode;
		std::list<Arc*> arcs;	//needs to be a list of pointers to Arcs, 
		//as I will be using the address to delete particular Arcs
	};

	std::list<Node*> graphNodesList;
	int countOfNodes = 0;

	//---------------- END GRAPH STRUCTURES------------------------
	//--------------------- TRAVERSALS ----------------------------

	void BFSRun(Node* current)
	{
		static std::queue<Node*> nextNodeToProcess;
		std::cout << current->dataContainedAtNode << std::endl;

		if (current->arcs.empty())
		{
			current->status = FINISHED;
			return;
		}
		else
		{
			for (std::list<Arc*>::iterator traversesArcs = current->arcs.begin();
				traversesArcs != current->arcs.end(); traversesArcs++)
			{
				if ((*traversesArcs)->nodeArcPointsTo->status == UNDISCOVERED)
				{
					(*traversesArcs)->nodeArcPointsTo->status = PROCESSING;
					nextNodeToProcess.push((*traversesArcs)->nodeArcPointsTo);
				}
			}

			current->status = FINISHED;

			if (nextNodeToProcess.empty())
			{
				return;
			}
			else
			{
				Node* nextToTraverse = nextNodeToProcess.front();
				nextNodeToProcess.pop();
				BFSRun(nextToTraverse);
			}
		}
	}

	void DFSRun(Node* current)
	{
		current->notVisitedYet = false;
		std::cout << current->dataContainedAtNode << std::endl;

		if (current->arcs.empty())
		{
			//if the Arcs are empty at this node, we do not need to do anything.
			return;
		}
		else
		{
			for (std::list<Arc*>::iterator traversesArcs = current->arcs.begin();
				traversesArcs != current->arcs.end(); traversesArcs++)
			{
				if ((*traversesArcs)->nodeArcPointsTo->notVisitedYet)
				{
					DFSRun((*traversesArcs)->nodeArcPointsTo);
				}
			}
			return;
		}
	}

	void resetNodesColor()
	{
		std::list<Node*>::iterator traversesGraphNodes = graphNodesList.begin();
		for (std::list<Node*>::iterator traversesGraphNodes = graphNodesList.begin();
			traversesGraphNodes != graphNodesList.end(); traversesGraphNodes++)
		{
			(*traversesGraphNodes)->status = UNDISCOVERED;
		}
	}

	void resetNodesStatus()
	{
		std::list<Node*>::iterator traversesGraphNodes = graphNodesList.begin();
		for (std::list<Node*>::iterator traversesGraphNodes = graphNodesList.begin();
			traversesGraphNodes != graphNodesList.end(); traversesGraphNodes++)
		{
			(*traversesGraphNodes)->notVisitedYet = true;
		}
	}

	//----------------- END TRAVERSALS ----------------------------
	//--------------------OPERATIONS-------------------------------

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
	}

	void addNode(T newNodeData)
	{
		Node* newNode = new Node;
		newNode->dataContainedAtNode = newNodeData;
		graphNodesList.push_back(newNode);
		countOfNodes++;
	}

	void addArc(T nodeToAddArc, T newArcLinkTo, int newArcWeight)
	{
		Node* sourceOfArc = findNode(nodeToAddArc);
		Node* destinationOfArc = findNode(newArcLinkTo);
		Arc* newArc = new Arc;
		newArc->nodeArcPointsFrom = sourceOfArc;
		newArc->weight = newArcWeight;
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
		countOfNodes--;
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
		Node* startPointerForDFSRun = findNode(startDFSFromThisNode);
		DFSRun(startPointerForDFSRun);
		resetNodesStatus();
	}

	void breadthFirstSearch(T nodeToBeginSearchAt)
	{
		Node* nodePointerToStartBFSAt = findNode(nodeToBeginSearchAt);
		nodePointerToStartBFSAt->status = PROCESSING;
		BFSRun(nodePointerToStartBFSAt);
		resetNodesStatus();
	}

	//------------------END OPERATIONS-----------------------------

	//--------------- MINIMUM SPANNING TREES ----------------------

	bool unvisitedNodeExistsFromVistedElements(std::list<Node*> visitedNodes)
	{
		for (std::list<Node*>::iterator findsNode = visitedNodes.begin(); findsNode != visitedNodes.end(); findsNode++)
		{
			std::list<Arc*>::iterator findsArc = (*findsNode)->arcs.begin();
			for (; findsArc != (*findsNode)->arcs.end(); findsArc++)
			{
				if (((*findsArc)->nodeArcPointsTo->notVisitedYet))
				{
					return true;
				}
			}
		}
		return false;
	}

	WeightedDiGraph primsAlgorithm(T nodeToStartAt)
	{
		WeightedDiGraph<T> MST;
		std::list<Node*> visitedNodes;
		Node* startNode = findNode(nodeToStartAt);

		MST.addNode(startNode->dataContainedAtNode);
		startNode->notVisitedYet = false;
		visitedNodes.push_front(startNode);

		while (unvisitedNodeExistsFromVistedElements(visitedNodes))
		{
			Node* smallestEdgeToUnvisitedNode = findNodeWithSmallestEdge(visitedNodes);
			MST.addNode(findNodeSmallestEdgeGoesTo(smallestEdgeToUnvisitedNode)->dataContainedAtNode);
			smallestEdgeToUnvisitedNode->notVisitedYet = false;

			T makeEdgeFrom = smallestEdgeToUnvisitedNode->dataContainedAtNode;
			T makeEdgeTo = findNodeSmallestEdgeGoesTo(smallestEdgeToUnvisitedNode)->dataContainedAtNode;
			int weightOfEdge = findWeightOfSmallestEdge(smallestEdgeToUnvisitedNode);

			MST.addArc(makeEdgeFrom, makeEdgeTo, weightOfEdge);
			visitedNodes.push_front(findNodeSmallestEdgeGoesTo(smallestEdgeToUnvisitedNode));
			(*visitedNodes.begin())->notVisitedYet = false;
		}
		return MST;
	}
	
	Node* findNodeWithSmallestEdge(std::list<Node*> visitedNodes) //working
	{
		Node* smallestEdgedNode = NULL;
		int smallestEdge = 1000000;
		
	
		for (std::list<Node*>::iterator findsNode = visitedNodes.begin(); findsNode != visitedNodes.end(); findsNode++)
		{
			std::list<Arc*>::iterator findsArc = (*findsNode)->arcs.begin();
			for (; findsArc != (*findsNode)->arcs.end(); findsArc++)
			{
				if (((*findsArc)->weight < smallestEdge) && ((*findsArc)->nodeArcPointsTo->notVisitedYet))
				{
					smallestEdgedNode = *findsNode;
					smallestEdge = (*findsArc)->weight;
				}
			}
		}
		return smallestEdgedNode;
	}

	Node* findNodeSmallestEdgeGoesTo(Node* smallestEdgeToUnvisitedNode) //working
	{
		std::list<Arc*>::iterator findsSmallestArc = smallestEdgeToUnvisitedNode->arcs.begin();

		while (((*findsSmallestArc)->nodeArcPointsTo->notVisitedYet == false) && (findsSmallestArc != smallestEdgeToUnvisitedNode->arcs.end())){
			findsSmallestArc++;
		}

		Arc* smallestArc = *findsSmallestArc;

		//int smallestWeight = (*smallestEdgeToUnvisitedNode->arcs.begin())->weight;
		for (; findsSmallestArc != smallestEdgeToUnvisitedNode->arcs.end(); findsSmallestArc++)
		{
			if (((*findsSmallestArc)->weight < smallestArc->weight) && ((*findsSmallestArc)->nodeArcPointsTo->notVisitedYet))
			{
				smallestArc = *findsSmallestArc;
			}
		}
		return smallestArc->nodeArcPointsTo;
	}

	int findWeightOfSmallestEdge(Node* smallestEdgeToUnvisitedNode)
	{
		std::list<Arc*>::iterator findsSmallestArc = smallestEdgeToUnvisitedNode->arcs.begin();

		while (((*findsSmallestArc)->nodeArcPointsTo->notVisitedYet == false) && (findsSmallestArc != smallestEdgeToUnvisitedNode->arcs.end())){
			findsSmallestArc++;
		}

		Arc* smallestArc = *findsSmallestArc;

		int smallestWeight = (*smallestEdgeToUnvisitedNode->arcs.begin())->weight;
		for (; findsSmallestArc != smallestEdgeToUnvisitedNode->arcs.end(); findsSmallestArc++)
		{
			if (((*findsSmallestArc)->weight < smallestArc->weight) && ((*findsSmallestArc)->nodeArcPointsTo->notVisitedYet))
			{
				smallestArc = *findsSmallestArc;
			}
		}
		return smallestArc->weight;
	}

	//----------- END MINIMUM SPANNING TREES ----------------------
};

int main()
{
	WeightedDiGraph<int> intGraph;

	intGraph.addNode(0);
	intGraph.addNode(1);
	intGraph.addNode(2);
	intGraph.addNode(3);
	intGraph.addNode(4);
	intGraph.addNode(5);
	intGraph.addNode(6);
	intGraph.addNode(7);

	
	//1
	intGraph.addArc(1, 3, 3);
	intGraph.addArc(1, 5, 5);

	//3
	intGraph.addArc(3, 1, 3);
	intGraph.addArc(3, 7, 9);
	//5
	intGraph.addArc(5, 1, 5);
	intGraph.addArc(5, 2, 3);
	intGraph.addArc(5, 6, 7);
	//7
	intGraph.addArc(7, 3, 9);

	//2
	intGraph.addArc(2, 6, 4);
	intGraph.addArc(2, 5, 3);

	//6
	intGraph.addArc(6, 2, 4);
	intGraph.addArc(6, 5, 7);

	WeightedDiGraph<int> MST = intGraph.primsAlgorithm(1);
	

	system("pause");
}