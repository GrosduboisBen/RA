import { EmptyState, Layout, Page, ResourceList, Card, Banner } from '@shopify/polaris';
import { ResourcePicker } from '@shopify/app-bridge-react';
import store from 'store-js';
import ResourceListWithLocations from "../components/Save.ResourceList"
const img = 'https://cdn.shopify.com/s/files/1/0757/9955/files/empty-state.svg';

class Index extends React.Component {

  state = { open: false };
  render() {
    return (
      <Page>
        <Card>
          <Banner title="Modify Your Locations Pick Up Dates">
          </Banner>
        </Card>
          <ResourceListWithLocations />

      </Page>
    );
  }
}

export default Index;

