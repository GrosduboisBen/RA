import gql from 'graphql-tag';
import { Query } from 'react-apollo';
import {
  Card,
  ResourceList,
  Stack,
  TextStyle,
  Thumbnail,
} from '@shopify/polaris';
import store from 'store-js';
import { Redirect} from '@shopify/app-bridge/actions';
import { Context } from '@shopify/app-bridge-react';

const GET_STOCK_BY_ID = gql`
  { 
    locations(first:10){
      edges{
        node{
        id
        name
    }
    }
  }
}
`;
class ResourceListWithLocations extends React.Component {
  static contextType = Context;

  render() {
    const app = this.context;
    const redirectToProduct = () => {
      const redirect = Redirect.create(app);
      redirect.dispatch(
        Redirect.Action.APP,
        '/edit-products',
      );
    };

    return (
      <Query query={GET_STOCK_BY_ID}>
        {({ data, loading, error }) => {
          if (loading) { return <div>Loading…</div>; }
          if (error) { return <div>{error.message}</div>; }
          console.log(data);
        
          
          return (
            <Card>
              <ResourceList
                showHeader
                resourceName={{ singular: 'Location', plural: 'Locations' }}
                items={data.locations.edges}
                renderItem={(item) => {
                  return (
                    <ResourceList.Item
                      id={item.node.id}
                      accessibilityLabel={`View details for ${item.node.name}`}
                      onClick={() => {
                        store.set('item', item); 
                        redirectToProduct();  
                      }
                      }
                    >
                      <Stack>
                        <Stack.Item fill>
                          <h3>
                            <TextStyle variation="strong">
                              {item.node.name}
                            </TextStyle>
                          </h3>
                        </Stack.Item>
                      </Stack>
                    </ResourceList.Item>
                  );
                }}
              />
            </Card>
          );
        }}
      </Query>
    );
  }
}

export default ResourceListWithLocations;