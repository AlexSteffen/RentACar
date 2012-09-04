/*
	RentACarSQLException.h
	The implementation of properties and methods for the RentACarSQLException object.
	Generated by SudzC.com
*/
#import "RentACarSQLException.h"

#import "RentACarSQLException.h"
@implementation RentACarSQLException
	@synthesize SQLState = _SQLState;
	@synthesize errorCode = _errorCode;
	@synthesize nextException = _nextException;

	- (id) init
	{
		if(self = [super init])
		{
			self.SQLState = nil;
			self.nextException = nil; // [[RentACarSQLException alloc] init];

		}
		return self;
	}

	+ (RentACarSQLException*) newWithNode: (CXMLNode*) node
	{
		if(node == nil) { return nil; }
		return (RentACarSQLException*)[[RentACarSQLException alloc] initWithNode: node];
	}

	- (id) initWithNode: (CXMLNode*) node {
		if(self = [super initWithNode: node])
		{
			self.SQLState = [Soap getNodeValue: node withName: @"SQLState"];
			self.errorCode = [[Soap getNodeValue: node withName: @"errorCode"] intValue];
			self.nextException = [[RentACarSQLException newWithNode: [Soap getNode: node withName: @"nextException"]] object];
		}
		return self;
	}

	- (NSMutableString*) serialize
	{
		return [self serialize: @"SQLException"];
	}
  
	- (NSMutableString*) serialize: (NSString*) nodeName
	{
		NSMutableString* s = [NSMutableString string];
		[s appendFormat: @"<%@", nodeName];
		[s appendString: [self serializeAttributes]];
		[s appendString: @">"];
		[s appendString: [self serializeElements]];
		[s appendFormat: @"</%@>", nodeName];
		return s;
	}
	
	- (NSMutableString*) serializeElements
	{
		NSMutableString* s = [super serializeElements];
		if (self.SQLState != nil) [s appendFormat: @"<SQLState>%@</SQLState>", [[self.SQLState stringByReplacingOccurrencesOfString:@"\"" withString:@"&quot;"] stringByReplacingOccurrencesOfString:@"&" withString:@"&amp;"]];
		[s appendFormat: @"<errorCode>%@</errorCode>", [NSString stringWithFormat: @"%i", self.errorCode]];
		if (self.nextException != nil) [s appendString: [self.nextException serialize: @"nextException"]];

		return s;
	}
	
	- (NSMutableString*) serializeAttributes
	{
		NSMutableString* s = [super serializeAttributes];

		return s;
	}
	
	-(BOOL)isEqual:(id)object{
		if(object != nil && [object isKindOfClass:[RentACarSQLException class]]) {
			return [[self serialize] isEqualToString:[object serialize]];
		}
		return NO;
	}
	
	-(NSUInteger)hash{
		return [Soap generateHash:self];

	}

@end