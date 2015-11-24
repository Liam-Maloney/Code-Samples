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

	WeightedDiGraph primsAlgorithm(T nodeToStartAt)
	{
		//a. Initialise a new graph, which we will be returning as the Minimum spanning tree
		WeightedDiGraph<T> MST;
		//b. Create a list which will store the elements which are already in the MST
		//	This could be done in a much more efficient manner.
		std::list<Node*> visitedElements;
		//1. add the starting node to the graph as the only node.
		Node* originalNode = findNode(nodeToStartAt);
		MST.addNode(originalNode->dataContainedAtNode);
		originalNode->notVisitedYet = false;
		visitedElements.push_front(originalNode);
		while (this->countOfNodes > MST.countOfNodes)
		{
			Node* containsSmallestEdge = findNodeWithSmallestEdge(visitedElements);
			MST.addNode(findNodeSmallestEdgeGoesTo(containsSmallestEdge)->dataContainedAtNode);
			containsSmallestEdge->notVisitedYet = false;

			T makeEdgeFrom = containsSmallestEdge->dataContainedAtNode;
			T makeEdgeTo = findNodeSmallestEdgeGoesTo(containsSmallestEdge)->dataContainedAtNode;
			int weightOfEdge = findWeightOfSmallestEdge(containsSmallestEdge);

			MST.addArc(makeEdgeFrom, makeEdgeTo, weightOfEdge);
			visitedElements.push_front(findNodeSmallestEdgeGoesTo(containsSmallestEdge));
			(*visitedElements.begin())->notVisitedYet = false;
			//2.	while there are still outstanding nodes in the original graph, pick from the
			//		list of visited nodes (IE, ones already in the graph), 
			//		the smallest weighted edge to an unvisited node 
			//		(IE, one which is not in the visited list).
			//		Add this node to the visited List, and add this node with its edge to the MST
			//		Graph.
			//3. return the MST Graph.
		}
		return MST;
	}
	
	Node* findNodeWithSmallestEdge(std::list<Node*> visitedElements) //working
	{
		Node* smallestEdgedNode = NULL;
		int smallestEdge = 1000000;
		
		//intialise the smallest to the visited Nodes, first elements, first arc weight
		//smallestEdge = (*((*(*(visitedElements.begin()))).arcs.begin()))->weight;
		//smallestEdge = (*((*(*(visitedElements.begin()))).arcs.begin()))->weight;

		for (std::list<Node*>::iterator findsNode = visitedElements.begin(); findsNode != visitedElements.end(); findsNode++)
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

	Node* findNodeSmallestEdgeGoesTo(Node* containsSmallestEdge) //working
	{
		std::list<Arc*>::iterator findsSmallestArc = containsSmallestEdge->arcs.begin();

		while (((*findsSmallestArc)->nodeArcPointsTo->notVisitedYet == false) && (findsSmallestArc != containsSmallestEdge->arcs.end())){
			findsSmallestArc++;
		}

		Arc* smallestArc = *findsSmallestArc;

		//int smallestWeight = (*containsSmallestEdge->arcs.begin())->weight;
		for (; findsSmallestArc != containsSmallestEdge->arcs.end(); findsSmallestArc++)
		{
			if (((*findsSmallestArc)->weight < smallestArc->weight) && ((*findsSmallestArc)->nodeArcPointsTo->notVisitedYet))
			{
				smallestArc = *findsSmallestArc;
			}
		}
		return smallestArc->nodeArcPointsTo;
	}

	int findWeightOfSmallestEdge(Node* containsSmallestEdge)
	{
		std::list<Arc*>::iterator findsSmallestArc = containsSmallestEdge->arcs.begin();

		while (((*findsSmallestArc)->nodeArcPointsTo->notVisitedYet == false) && (findsSmallestArc != containsSmallestEdge->arcs.end())){
			findsSmallestArc++;
		}

		Arc* smallestArc = *findsSmallestArc;

		int smallestWeight = (*containsSmallestEdge->arcs.begin())->weight;
		for (; findsSmallestArc != containsSmallestEdge->arcs.end(); findsSmallestArc++)
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

	intGraph.addNode(10);
	intGraph.addNode(9);
	intGraph.addNode(11);
	intGraph.addNode(1);
	intGraph.addNode(8);
	intGraph.addNode(3);
	intGraph.addNode(2);
	intGraph.addNode(5);
	intGraph.addNode(7);
	intGraph.addNode(4);
	intGraph.addNode(6);
	
	//10
	intGraph.addArc(10, 9, 10);
	intGraph.addArc(10, 1, 12);
	intGraph.addArc(10, 11, 8);

	//9
	intGraph.addArc(9, 10, 10);
	intGraph.addArc(9, 1, 6);
	intGraph.addArc(9, 8, 3);

	//11
	intGraph.addArc(11, 10, 8);
	intGraph.addArc(11, 1, 3);
	intGraph.addArc(11, 3, 5);

	//1
	intGraph.addArc(1, 10, 12);
	intGraph.addArc(1, 9, 6);
	intGraph.addArc(1, 8, 10);
	intGraph.addArc(1, 7, 9);
	intGraph.addArc(1, 2, 8);
	intGraph.addArc(1, 11, 3);

	//8
	intGraph.addArc(8, 9, 3);
	intGraph.addArc(8, 1, 10);
	intGraph.addArc(8, 7, 7);

	//3
	intGraph.addArc(3, 11, 5);
	intGraph.addArc(3, 2, 10);
	intGraph.addArc(3, 4, 9);

	//2
	intGraph.addArc(2, 1, 8);
	intGraph.addArc(2, 5, 2);
	intGraph.addArc(2, 3, 10);
	intGraph.addArc(2, 11, 7);

	//5
	intGraph.addArc(5, 2, 2);
	intGraph.addArc(5, 7, 6);
	intGraph.addArc(5, 6, 10);
	intGraph.addArc(5, 4, 13);

	//7
	intGraph.addArc(7, 8, 7);
	intGraph.addArc(7, 6, 8);
	intGraph.addArc(7, 5, 6);
	intGraph.addArc(7, 1, 9);

	//4
	intGraph.addArc(4, 3, 9);
	intGraph.addArc(4, 5, 13);
	intGraph.addArc(4, 6, 12);

	//6
	intGraph.addArc(6, 7, 8);
	intGraph.addArc(6, 4, 12);
	intGraph.addArc(6, 5, 10);

	WeightedDiGraph<int> MST = intGraph.primsAlgorithm(1);

	system("pause");
}