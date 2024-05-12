#include <iostream>
#include <unistd.h>
using namespace std;
pid_t pid;
int main(){
    
    cout<<"\nParent process id: "<<getpid()<<endl;
    fork();
    cout<<"chiled 1 process id: "<<getpid<<endl;
    
    fork();
    cout<<"chiled 2 process id: "<<getpid()<<endl;
    
    return 1;    
}
