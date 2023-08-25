/*Queues are frequently used in computer programming, and a typical example is the creation of a job queue by an operating system.
If the operating system does not use priorities, then the jobs are processed in the order they enter the system.
Write C++ program for simulating job queue.
Write functions to add job and delete job from queue.*/

#include<iostream>
#include<iomanip>
using namespace std;
struct job
{  int jno,t1,t2,t3;

 };
class queue
{   job j[20]; int front,rear;

    public:
      queue()
       { front=-1; rear=-1; }
      void insert();
      void exe();

};
void queue::insert()
{   front=0;
    rear++;
     if(rear<20)
      {
     cout<<"\nenter the job no.";
     cin>>j[rear].jno;


     cout<<"\nenter execution time";
     cin>>j[rear].t1;

       }
     else
      cout<<"\n QUEUE IS FULL";
}
void queue::exe()
{
    j[front].t2=0;
    j[front].t3=j[front].t1;
cout<<"\n______________________________________________";


       cout<<"\n| time of start of job:              :"<<setw(5)<<j[front].t2<<" s|";
       cout<<"\n| time requried for complition of job:"<<setw(5)<<j[front].t1<<" s|";
       cout<<"\n| time of complition                 :"<<setw(5)<<j[front].t3<<" s|";
       cout<<"\n|____________________________________________|";
          front++;
 while(front<=rear)
    {
       j[front].t2=j[front-1].t3+1;
       j[front].t3=j[front].t1+j[front].t2-1;




    cout<<"\n______________________________________________";


       cout<<"\n| time of start of job:              :"<<setw(5)<<j[front].t2<<" s|";
       cout<<"\n| time requried for complition of job:"<<setw(5)<<j[front].t1<<" s|";
       cout<<"\n| time of complition                 :"<<setw(5)<<j[front].t3<<" s|";
       cout<<"\n|____________________________________________|";
      front++;
    }
}
int main()
{    queue q;
     char ch;
     cout<<"\n____________________________________________";
     do
     {       q.insert();
            cout<<"\n____________________________________________";
         cout<<"\n do you want to continue to enter press y";
         cin>>ch;
         cout<<"\n____________________________________________";
     }while(ch=='y'||ch=='Y');

        cout<<"\n______________________________________________";
        cout<<"\n|     NOW EXECUTION OF JOBS ARE STARTED      |";
        cout<<"\n|____________________________________________|";
        q.exe();


          return 0;
}
